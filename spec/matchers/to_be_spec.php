<?php

describe("toBe matcher", function() {

  it("matches two strings", function() {
    $result = expect('foo')->toBe('foo');
    expect($result)->toBeTruthy();
  });

  it("doesn't cast integers", function() {
    $result = expect(1)->not->toBe('1');
    expect($result)->toBeTruthy();
  });

});
