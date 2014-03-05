<?php

describe("toBeTruthy matcher", function() {

  it("tests for a true value", function() {
    $result = expect(true)->toBeTruthy();
    expect($result)->toBeTruthy();
  });

  it("doesn't typecast", function() {
    $result = expect('true')->not->toBeTruthy();
    expect($result)->toBeTruthy();
  });

});
