<?php

// Lazy loading of Huck class files
spl_autoload_register(array('Huck', 'autoload'));

/**
 * Describes a test suite
 *
 * @param string $description 
 * @param function $callback needs to be callable with call_user_func()
 * @return void
 * @author Baylor Rae'
 */
function describe($description, $callback) {
  Huck::runner()->describe($description, $callback);
}

function it($description, $callback) {
  Huck::runner()->it($description, $callback);
}

function expect($actual) {
  // Huck::runner()->spec->
  return new Huck_Expect($actual, Huck::runner()->spec);
}

function xdescribe($description, $callback) {
  // don't do anything
}

function xit($description, $callback) {
  // don't do anything
}

class Huck {
  
  // Contains our "runner"
  private static $runner = null;
  public static $matchers = array();
  
  /**
   * Makes sure there is only one runner in the class.
   * The runner is a "foreman" that keeps up with all Suites, Specs and Tests
   *
   * @return Huck_Runner
   * @author Baylor Rae'
   */
  public static function runner() {
    if( self::$runner === null )
      self::$runner = new Huck_Runner;
    
    return self::$runner;
  }
  
  /**
   * Runs all of the suites and specs
   *
   * @return array
   * @author Baylor Rae'
   */
  public static function run() {
    return self::runner()->run();
  }
  
  /**
   * Adds a matcher for testing
   *
   * @param string $name 
   * @param function $test needs to return a boolean value
   * @return void
   * @author Baylor Rae'
   */
  public static function addMatcher($name, $test) {
    self::$matchers[$name] = $test;
  }
  
  /**
   * Auto loads any class files needed
   *
   * @package default
   * @author Baylor Rae'
   */
  public static function autoload($class_name) {
    // Make sure the class starts with Huck_
    if( substr($class_name, 0, 5) === 'Huck_' ) {
      
      // If the file exists then load it.
      $file = dirname(__FILE__) . '/' . substr($class_name, 5) . '.php';
      if( file_exists($file) )
        require_once $file;
    }
  }
  
  public static function defaultMatchers() {
    self::addMatcher('toEqual', function($actual, $expected) {
      return $actual == $expected;
    });
    
    self::addMatcher('toBe', function($actual, $expected) {
      return $actual === $expected;
    });
    
    self::addMatcher('toMatch', function($actual, $pattern) {
      return preg_match($pattern, $actual);
    });
    
    self::addMatcher('toBeNull', function($actual, $expected) {
      return $actual === null;
    });
    
    self::addMatcher('toBeTruthy', function($actual, $expected) {
      return $actual === true;
    });
    
    self::addMatcher('toBeFalsy', function($actual, $expected) {
      return $actual === false;
    });
    
    self::addMatcher('toContain', function($actual, $expected) {
      if( is_string($expected) || is_integer($expected) )
        $in_array = array_key_exists($expected, $actual);
      
      return $in_array || in_array($expected, $actual);
    });
    
    self::addMatcher('toBeLessThan', function($actual, $expected) {
      return $actual < $expected;
    });
    
    self::addMatcher('toBeGreaterThan', function($actual, $expected) {
      return $actual > $expected;
    });
    
    self::addMatcher('toBeEmpty', function($actual) {
      return empty($actual);
    });
    
    self::addMatcher('toBeString', function($actual) {
      return is_string($actual);
    });
    
    self::addMatcher('toBeInteger', function($actual) {
      return is_integer($actual);
    });
    
    self::addMatcher('toBeArray', function($actual) {
      return is_array($actual);
    });
    
    self::addMatcher('toBeInstanceOf', function($actual, $expected) {
      return $actual instanceof $expected;
    });
  }
  
}

Huck::defaultMatchers();