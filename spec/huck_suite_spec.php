<?php

describe("Huck_Suite", function() {

  it("stores the parent suite", function() {
    $parent = new Huck_Suite('a parent suite');
    $child = new Huck_Suite('a child suite', $parent);

    expect($child->parent)->toBe($parent);
  });

  describe("variables", function() {
    let('variables', array(
        'foo' => 'bar',
        'cheese' => 'good'
    ));

    it("accesses stores variables as an object", function($spec) {
      $suite = new Huck_Suite('a test suite');

      $suite->variables = $spec->variables;

      expect($suite->getVariables())->toEqual((object) $spec->variables);
    });

    it("resolves closures", function() {
      $parent = new Huck_Suite('a parent suite');
      $parent->variables = array(
        'foo' => 'bar',
        'foobar' => function($spec) {
          return 'foo' . $spec->foo . 'baz';
        }
      );

      expect($parent->getVariables())->toEqual((object) array(
        'foo' => 'bar',
        'foobar' => 'foobarbaz'
      ));
    });
  });

});
