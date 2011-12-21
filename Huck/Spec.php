<?php

/**
 * Holds the spec's description and callback
 * also holds its parent Suite
 *
 * @package Huck
 * @author Baylor Rae'
 */
class Huck_Spec {
  
  public $description = null,
         $callback = null,
         $parent = null;
         
  function __construct($description, $callback, $parent) {
    $this->description = $description;
    $this->callback = $callback;
    $this->parent = $parent;
  }
  
  
  
}