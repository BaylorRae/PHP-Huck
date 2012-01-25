<?php

/**
 * Runs all the tests for each Spec
 *
 * @package Huck
 * @author Baylor Rae'
 */
class Huck_Expect {
  
  public $actual = null,
         $spec = null,
         
         $not = null,
         $useNot = false;
  
  /**
   * Stores the information needed for each test
   *
   * @param mixed $actual The value being tested
   * @param Huck_Spec $spec The spec being used
   * @author Baylor Rae'
   */
  function __construct($actual, $spec, $useNot = false) {
    $this->actual = $actual;
    $this->spec = $spec;
    $this->useNot = $useNot;
    
    if( $useNot == false )
      $this->not = new Huck_Expect($actual, $spec, true);
  }
  
  /**
   * Tries to call a matcher from Huck::$matchers[$name]
   * Creates a Huck_Result
   *
   * @param name $name 
   * @param name $expected
   * @return void
   * @author Baylor Rae'
   */
  function __call($name, $args) {
    if( isset(Huck::$matchers[$name]) ) {
      $expected = isset($args[0]) ? $args[0] : null;
            
      $success = !!call_user_func_array(Huck::$matchers[$name], array($this->actual, $expected));
      
      if( $this->useNot )
        $success = !$success;
        
      $result = new Huck_Result(array(
        'success' => $success,
        'description' => $this->spec->description,
        'actual' => $this->actual,
        'expected' => $expected
      ));
      
      if( !$success ) {
        $result->error_message = $this->errorMessage($name, $this->actual, $expected);
        ++$this->spec->parent->failures;
      }
      
      $this->spec->parent->results[] = $result;
    }
  }
  
  /**
   * Creates a readable error message
   *
   * @param string $matcher e.g toBe
   * @param string $actual the value that was tested
   * @param string $expected the value that was expected
   * @return string e.g. "Expected $actual to be $expected"
   * @author Baylor Rae'
   */
  private function errorMessage($matcher, $actual, $expected) {
    
    // based on answer here: http://stackoverflow.com/a/7729790/467546
    $matcher = strtolower(implode(preg_split('/(?<=[a-z])(?=[A-Z])/x', $matcher), ' '));
    
    // specify the type
    if( $this->useNot )
      $matcher = 'not ' . $matcher;
    
    // replace text to read properly
    $matcher = str_replace(array('truthy', 'falsy'), array('true', 'fase'), $matcher);
    
    // start the error message
    $error_message = 'Expected ';
    
    // print the $actual value properly
    if( is_array($actual) )
      $error_message .= '<pre>%s</pre>';
    else
      $error_message .= '%s';
    
    // matcher text e.g to be
    $error_message .= ' %s';
    
    // print the $expected value properly
    if( is_array($expected) )
      $error_message .= '<pre>%s</pre>';
    elseif( !is_bool($expected) && !empty($expected) )
      $error_message .= ' %s';
      
    return sprintf($error_message, var_export($actual, true), $matcher, var_export($expected, true));
  }
  
}