<?php

describe("toBeLessThan matcher", function() {

  it("tests that values it less than", function() {
    $result = expect(3)->toBeLessThan(5);
    expect($result)->toBeTruthy();
  });

  it("fails when values are equal", function() {
    $result = expect(1)->not->toBeLessThan(1);
    expect($result)->toBeTruthy();
  });

  it("fails when values are greater", function() {
    $result = expect(100)->not->toBeLessThan(50);
    expect($result)->toBeTruthy();
  });

});
