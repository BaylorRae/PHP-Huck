<?php

describe('Lets Integration', function() {

  let('foo', 'bar');

  it("gives me access to lets", function($spec) {
    expect($spec->foo)->toBe('bar');
  });
  
});

