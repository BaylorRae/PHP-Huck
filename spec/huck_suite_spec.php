<?php

describe("Huck_Suite", function() {

  let('variables', array(
      'foo' => 'bar',
      'cheese' => 'good'
  ));

  it("accesses stores variables as an object", function($spec) {
    $suite = new Huck_Suite('a test suite');

    $suite->variables = $spec->variables;

    expect($suite->getVariables())->toEqual((object) $spec->variables);
  });

  it("stores the parent suite", function() {
    $parent = new Huck_Suite('a parent suite');
    $child = new Huck_Suite('a child suite', $parent);

    expect($child->parent)->toBe($parent);
  });

});
