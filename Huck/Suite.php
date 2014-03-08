<?php

/**
 * Holds all specs underneath it
 * and keeps up with their results
 *
 * @package Huck
 * @author Baylor Rae'
 */
class Huck_Suite {
  
  public $description = null,
         $failures = 0,
         $specs = array(),
         $results = array(),
         
         // user defined variables
         $variables;
  
  function __construct($description, $parent = null) {
    $this->description = $description;
    $this->parent = $parent;
  }
  
  public function getVariables() {
    $vars = (object) $this->variables;

    $vars = $this->resolveClosures($vars);

    return $vars;
  }

  /**
   * Finds all variables that are a function
   * and invokes each one passing in an
   * object with the current suite's variables.
   *
   * @param object $vars
   * @return object
   */
  private function resolveClosures($vars) {
    foreach( $vars as $key => $value ) {
      if( is_callable($value) ) {
        $vars->$key = call_user_func($value, $vars);
      }
    }

    return $vars;
  }
}
