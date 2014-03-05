<?php

describe("toBeArray matcher", function() {

  it("matches arrays", function() {
    $result = expect(array())->toBeArray();
    expect($result)->toBeTruthy();
  });

  it("doesn't match non strings", function() {
    $types = array('foo', new StdClass(), 1);

    foreach( $types as $type) {
      $result = expect($type)->not->toBeArray();
      expect($result)->toBeTruthy();
    }
  });

});


