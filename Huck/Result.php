<?php

/**
 * Stores the result of a test
 *
 * @package Huck
 * @author Baylor Rae'
 */
class Huck_Result {
  
  public $success = false,
         $description,
         $actual,
         $expected,
         $error_message;
  
  /**
   * Loops through all keys and values
   * and saves them to the class properties
   *
   * @param array $values 
   * @author Baylor Rae'
   */
  function __construct($values) {
    if( !is_array($values) )
      return;
    
    foreach( $values as $key => $val )
      $this->$key = $val;
  }
  
}