<?php

describe("toContain matcher", function() {

  it("tests for array key by string", function() {
    $result = expect(array('a' => 'foo'))->toContain('a');
    expect($result)->toBeTruthy();
  });

  it("tests for array key by integer", function() {
    $result = expect(array(1337 => 'foo'))->toContain(1337);
    expect($result)->toBeTruthy();
  });

  it("tests for value", function() {
    $result = expect(array('foo', 'bar', 'baz'))->toContain('bar');
    expect($result)->toBeTruthy();
});

});
