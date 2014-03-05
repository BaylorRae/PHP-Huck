<?php

describe("toBeInstanceOf matcher", function() {
  class Foo {}

  it("matches inherited classes", function() {
    class Bar extends Foo {}

    $result = expect(new Bar)->toBeInstanceOf(new Foo);
    expect($result)->toBeTruthy();
  });

  it("doesn't match wrong classes", function() {
    $result = expect(new StdClass)->not->toBeInstanceOf(new Foo);
    expect($result)->toBeTruthy();
  });

});
