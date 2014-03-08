<?php

describe("Huck_Runner", function() {

  it("stores variables for a test suite", function() {
    $runner = new Huck_Runner;

    $runner->describe('test', function() {});
    $runner->addVariable('foobar', 'some value');
    $suite = $runner->suite;
    $vars = $suite->getVariables();

    expect($vars->foobar)->toEqual('some value');
  });
});
