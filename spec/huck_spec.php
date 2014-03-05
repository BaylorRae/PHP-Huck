<?php

describe('Huck', function() {

  $default_matchers = array(
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
  );

  it('returns all available matchers', function() use($default_matchers) {
    expect(Huck::getMatchers())->toBe($default_matchers);
  });

  it('resets to default matchers', function() use($default_matchers) {
    Huck::addMatcher('foobar', function() {});
    Huck::resetMatchers();
    expect(Huck::getMatchers())->toBe($default_matchers);
  });

  it('adds a matcher', function() {
    Huck::addMatcher('toHaveCheese', function() {});
    expect(Huck::getMatchers())->toContain('toHaveCheese');
  });

});
