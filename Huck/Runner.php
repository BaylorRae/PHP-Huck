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
    $this->suites[] = $this->suite = $suite;
    call_user_func($callback);
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
      Huck_Benchmark::start($hash);
      foreach( $suite->specs as $spec ) {
        $this->spec = $spec;
        call_user_func($spec->callback);
      }
      
      $output[$suite->description] = array(
        'fails' => $suite->failures,
        'results' => $suite->results,
        'time' => Huck_Benchmark::check($hash) . 's',
        'hash' => $hash
      );
    }
    
    return $output;
  }
  
}