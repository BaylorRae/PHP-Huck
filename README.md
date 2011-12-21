# Huck
**A PHP Testing Framework**

```php
<?php
describe('Huck Fin', function() {
   
   it('should be Huck', function() {
      expect('Huck')->toBe('Huck'); 
   });
   
   it('should not be Huck', function() {
      expect('Tom')->not->toBe('Huck'); 
   });
    
});
?>
```

Huck is a BDD (Behavior Driven Development) framework based on [Jasmine for JS][jasmine_url]. It is designed for with a simple syntax to give it a low learning curve.

## How to Use
Huck runs in the browser. Just upload it to your server, create the specs and load `index.php`. Huck will automatically find all files in `specs/*_spec.php` and run them.

## Available Matchers
Huck includes most of the [matchers available in Jasmine][jasmine_matchers].

> `expect($x)->toEqual($y);` checks to see if `$x` and `$y` have the same value
>
> `expect($x)->toBe($y);` checks to see if `$x` and `$y` are identical. e.g. `1 !== '1'`
>
> `expect($x)->toMatch($pattern);` compares `$x` to regular expression `$pattern`
>
> `expect($x)->toBeNull();` checks to see if `$x === null`
>
> `expect($x)->toBeTruthy();` checks if `$x === true`
>
> `expect($x)->toBeFalsy();` checks if `$x === false`
>
> `expect($x)->toContain($y);` checks to see if `(array) $x` contains `$y`. Runs [array_key_exists][array_key_exists] && [in_array][in_array]
>
> `expect($x)->toBeLessThan($y);` checks to see if `$x < $y`
>
> `expect($x)->toBeGreaterThan($y);` checks to see if `$x > $y`
>
> `expect($x)->toBeEmpty();` runs [empty][empty]
>
> `expect($x)->toBeString();` runs [is_string][is_string]
>
> `expect($x)->toBeInteger();` runs [is_int][is_int]
>
> `expect($x)->toBeArray();` runs [is_array][is_array]
>
> `expect($x)->toBeInstanceOf();` runs [instanceof type operator][instanceof]

You can invert any of the matches by using

<code>expect($x)<strong>->not</strong>->toEqual($y)</code>

## Custom Matchers
To create custom matchers run this in your spec file.

```php
<?php

/**
 * Checks to match length
 *
 * @param $actual the value passed into expect()
 * @param $expected the value passed into ->toBeLength()
 * @author Baylor Rae'
 */
Huck::addMatcher('toBeLength', function($actual, $expected) {
    if( !is_array($actual) && !is_array($expected) )
        return false;
    
    return count($actual) === count($expected);
});

?>
```

[jasmine_url]: https://github.com/pivotal/jasmine
[jasmine_matchers]: https://github.com/pivotal/jasmine/wiki/Matchers
[array_key_exists]: http://php.net/array_key_exists
[in_array]: http://php.net/in_array
[empty]: http://php.net/empty
[is_string]: http://php.net/is_string
[is_int]: http://php.net/is_int
[is_array]: http://php.net/is_array
[instanceof]: http://php.net/manual/en/language.operators.type.php