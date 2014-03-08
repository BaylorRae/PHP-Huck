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
  
  function __construct($description) {
    $this->description = $description;
  }
  
  public function getVariables() {
    return (object) $this->variables;
  }
}
