<?php

describe('toEqual matcher', function() {

  function test_equal($actual, $expected) {
    $result = expect($actual)->toEqual($expected);
    expect($result)->toBeTruthy();
  }

  it('matches two strings', function() {
    test_equal('foo', 'foo');
  });

  it('matches integers', function() {
    test_equal('1', 1);
    test_equal(1, '01');
  });

  it("it doesn't match strings and integers", function() {
    $result = expect('foo')->not->toEqual(1);
    expect($result)->toBeTruthy();
  });

});
