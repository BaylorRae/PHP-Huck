<?php

describe('Huck', function() {

  let('default_matchers', array(
    'toEqual',
    'toBe',
    'toMatch',
    'toBeNull',
    'toBeTruthy',
    'toBeFalsy',
    'toContain',
    'toBeLessThan',
    'toBeGreaterThan',
    'toBeEmpty',
    'toBeString',
    'toBeInteger',
    'toBeArray',
    'toBeInstanceOf'
  ));

  describe("getMatchers", function() {
    it('returns all available matchers', function($spec) {
      expect(Huck::getMatchers())->toBe($spec->default_matchers);
    });
  });

  describe("resetMatchers", function() {
    it('resets to default matchers', function($spec) {
      Huck::addMatcher('foobar', function() {});
      Huck::resetMatchers();
      expect(Huck::getMatchers())->toBe($spec->default_matchers);
    });
  });

  describe("addMatcher", function() {
    it('adds a matcher', function() {
      Huck::addMatcher('toHaveCheese', function() {});
      expect(Huck::getMatchers())->toContain('toHaveCheese');
    });
  });

});
