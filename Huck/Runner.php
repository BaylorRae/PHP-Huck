<?php

/**
 * The runner is a "foreman" that keeps up with all Suites, Specs and Tests
 *
 * @package Huck
 * @author Baylor Rae'
 */
class Huck_Runner {
  
  public $suites = array(),
         $suite = null,
         
         $spec = null,
         $result = null;

  private $root_suite;
  
  /**
   * Creates a new suite
   *
   * @param string $description 
   * @param function $callback 
   * @return void
   * @author Baylor Rae'
   */
  public function describe($description, $callback) {
    $suite = new Huck_Suite($description);

    // keep up with root suite
    if( $this->root_suite === null ) {
      $this->root_suite = $suite;
    }else {

      // set parent to root suite when available
      $suite->parent = $this->root_suite;
    }

    $this->suites[] = $this->suite = $suite;

    // add parent suite's variables to current
    if( !empty($this->root_suite) && $this->root_suite == $suite->parent ) {
      $suite->variables = $this->root_suite->variables;
    }

    call_user_func($callback);

    // reset root suite only when current suite is root
    if( empty($suite->parent) ) {
      $this->root_suite = null;
    }
  }
  
  /**
   * Creates a spec for the current suite
   *
   * @param string $description 
   * @param function $callback 
   * @return void
   * @author Baylor Rae'
   */
  public function it($description, $callback) {
    $spec = new Huck_Spec($description, $callback, $this->suite);
    $this->suite->specs[] = $spec;
  }

  /**
   * Stores variable into current suite.
   *
   * @param string $name
   * @param mixed $value
   * @return void
   * @author Baylor Rae'
   */
  public function addVariable($name, $value) {
    $this->suite->variables[$name] = $value;
  }
  
  /**
   * Runs all Suites and Specs and returns the results
   *
   * @return array
   * @author Baylor Rae'
   */
  public function run() {
    if( empty($this->suites) )
      return;
    
    $output = array();
    foreach( $this->suites as $suite ) {
      if( empty($suite->specs) )
        continue;
      
      $hash = sha1($suite->description . microtime(true));
      $suite_variables = $suite->getVariables();

      Huck_Benchmark::start($hash);
      foreach( $suite->specs as $spec ) {
        $this->spec = $spec;
        call_user_func($spec->callback, $suite_variables);
      }
      
      $output[$suite->description] = array(
        'fails' => $suite->failures,
        'results' => $suite->results,
        'time' => Huck_Benchmark::check($hash),
        'hash' => $hash
      );
    }
    
    return $output;
  }
  
}
