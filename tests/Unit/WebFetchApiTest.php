<?php declare(strict_types=1);

use Bugo\Compat\WebFetchApi;

test('fetch method', function () {
	expect(WebFetchApi::fetch('https://foo.bar'))->toBeTrue();
});
