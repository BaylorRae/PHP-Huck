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
         $results = array();
  
  function __construct($description) {
    $this->description = $description;
  }
  
}