<?php

describe('All Tests', function() {
  
  it('should equal 1', function() {
    expect('1')->toEqual(1);
  });
    
  it('should be 1', function() {
    expect(1)->toBe(1);
  });
  
  it('should match', function() {
    expect('Huck')->toMatch('/uc/');
  });
  
  it('should be null', function() {
    expect(null)->toBeNull();
  });
  
  it('should be true', function() {
    expect(true)->toBeTruthy();
  });
  
  it('should be false', function() {
    expect(false)->toBeFalsy();
  });
  
  it('should contain', function() {
    expect(array('boys', 'will', 'be', 'boys'))->toContain('will');
  });
  
  it('should be less than', function() {
    expect(5)->toBeLessThan(10);
  });
  
  it('should be greater than', function() {
    expect(15)->toBeGreaterThan(10);
  });
  
  it('should be empty', function() {
    expect('')->toBeEmpty();
  });
  
  it('should be a string', function() {
    expect(implode(array('boys', 'will', 'be', 'boys'), ' '))->toBeString();
  });
  
  it('should be an integer', function() {
    expect(123)->toBeInteger();
  });
  
  it('should be an array', function() {
    expect(array('boys', 'will', 'be', 'boys'))->toBeArray();
  });
  
  it('should be an instance of', function() {
    class A {

    }

    class B extends A {

    }
    
    $a = new A;
    $b = new B;
    expect($b)->toBeInstanceOf($a);
  });
  
});