<?php

describe("toBeInteger matcher", function() {

  it("matches integers", function() {
    $result = expect(1)->toBeInteger();
    expect($result)->toBeTruthy();
  });

  it("doesn't match non strings", function() {
    $types = array('foo', new StdClass(), array());

    foreach( $types as $type) {
      $result = expect($type)->not->toBeInteger();
      expect($result)->toBeTruthy();
    }
  });

});

