<?php

describe("toBeNull matcher", function() {

  it("tests the value is null", function() {
    $result = expect(null)->toBeNull();
    expect($result)->toBeTruthy();
  });

  it("doesn't type cast", function() {
    $result = expect('null')->not->toBeNull();
    expect($result)->toBeTruthy();
  });

});
