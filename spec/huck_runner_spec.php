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

  it("passes variables to nested suite", function() {
    $runner = new Huck_Runner;

    $runner->describe('parent', function() use($runner) {

      $runner->addVariable('foo', 'value for child');

      $runner->describe('child', function() use($runner) {
        $runner->it("child has access to variable", function($spec) {
          expect($spec->foo)->toEqual('value for child');
        });
      });

      $runner->describe('child 2', function() use($runner) {
        $runner->it("child 2 has access to variable", function($spec) {
          expect($spec->foo)->toEqual('value for child');
        });
      });
    });

    $runner->describe('parent 2', function() use($runner) {
      $runner->it("doesn't have access to variable", function($spec) {
        expect($spec->foo)->toBeNull();
      });
    });

    $runner->run();
  });

});
