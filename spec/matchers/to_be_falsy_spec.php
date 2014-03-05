<?php

describe("toBeFalsy matcher", function() {


  it("tests for a false value", function() {
    $result = expect(false)->toBeFalsy();
    expect($result)->toBeTruthy();
  });

  it("doesn't typecast", function() {
    $result = expect('false')->not->toBeFalsy();
    expect($result)->toBeTruthy();
  });

});
