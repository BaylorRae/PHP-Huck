<?php

describe("toMatch matcher", function() {

  it("matches a regular expression", function() {
    $result = expect('cheese')->toMatch('/che{2}se/');
    expect($result)->toBeTruthy();
  });

});
