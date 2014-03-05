<?php

describe("toBeGreaterThan matchers", function() {

  it("tests that values are greater than", function() {
    $result = expect(10)->toBeGreaterThan(5);
    expect($result)->toBeTruthy();
  });

  it("fails when values are equal", function() {
    $result = expect(2)->not->toBeGreaterThan(2);
    expect($result)->toBeTruthy();
  });

  it("fails when values are lesser", function() {
    $result = expect(8)->not->toBeGreaterThan(16);
    expect($result)->toBeTruthy();
  });

});
