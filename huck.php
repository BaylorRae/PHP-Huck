#!/usr/bin/env php
<?php
require 'Huck/Huck.php';
define('EOL', "\n");

/**
 * Output colorized text to terminal
 *
 * @param string $text 
 * @param string $color 
 * @param string $use_line_break 
 * @return void
 * @author joeldg
 * @link http://snippets.dzone.com/posts/show/3292
 */
function puts($text, $color="NORMAL", $use_line_break = true){
    # first define colors to use
    $_colors = array(
            LIGHT_RED      => "[1;31m",
            LIGHT_GREEN     => "[1;32m",
            YELLOW         => "[1;33m",
            LIGHT_BLUE     => "[1;34m",
            MAGENTA     => "[1;35m",
            LIGHT_CYAN     => "[1;36m",
            WHITE         => "[1;37m",
            NORMAL         => "[0m",
            BLACK         => "[0;30m",
            RED         => "[0;31m",
            GREEN         => "[0;32m",
            BROWN         => "[0;33m",
            BLUE         => "[0;34m",
            CYAN         => "[0;36m",
            BOLD         => "[1m",
            UNDERSCORE     => "[4m",
            REVERSE     => "[7m",

    );
    
    $out = $_colors[$color];
    if($out == ""){ $out = "[0m"; }
    
    echo chr(27)."$out$text".chr(27).chr(27). "\033[0m"; #, EOL;
    if( $use_line_break )
      echo EOL;
}

function green($text, $line_break = true) {
  puts($text, GREEN, $line_break);
}

function red($text, $line_break = true) {
  puts($text, RED, $line_break);
}

function error($text, $line_break = true) {
  red($text, $line_break);
  die;
}

function pluralize($num, $word) {
  if( $num == 1 )
    return "$num $word";
  else
    return "$num {$word}s";
}

// make sure the file is present
if( empty($argv[1]) )
  error('Please include a file to load');

$file = $argv[1];

// make sure the file exists
if( !file_exists($file) )
  error('The file passed does not exist');

// load the file
require $file;

// get the results from running the specs
$result = Huck::run();
$description = key($result);
$test = $result[$description];

// create the quick statuses
foreach( $test['results'] as $result ) {
  if( $result->success )
    green('.', false);
  else
    red('F', false);
}

echo EOL, EOL;

puts("Finished in {$test['time']}");

$message = pluralize(count($test['results']), 'example') . ', ' . pluralize($test['fails'], 'failure');

if( $test['fails'] == 0 )
  green($message);
else {
  red($message);

  $counter = 0;

  echo EOL;
  puts("Failures:");
  foreach( $test['results'] as $result ) {
    if( $result->success )
      continue;

    ++$counter;
    puts("\t$counter) {$result->description}");
    
    // clean up the error message and display it
    $message = strip_tags($result->error_message);
    $message = str_replace(array("\n", '  '), array('', ' '), $message);
    
    red("\t   {$message}");
  }
}

echo EOL;
