<?php

describe("toBeString matcher", function() {

  it("matches strings", function() {
    $result = expect('string')->toBeString();
    expect($result)->toBeTruthy();
  });

  it("doesn't match non strings", function() {
    $types = array(1, new StdClass(), array());

    foreach( $types as $type) {
      $result = expect($type)->not->toBeString();
      expect($result)->toBeTruthy();
    }
  });

});
