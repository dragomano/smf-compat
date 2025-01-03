<?php declare(strict_types=1);

use Bugo\Compat\Utils;

beforeEach(function () {
	$this->utils = new Utils();
});

test('constructor', function () {
	expect($this->utils::$context)->toBeArray()
		->and($this->utils::$smcFunc)->toBeArray();
});

test('escapeJavaScript method', function () {
	expect($this->utils::escapeJavaScript('foo_bar'))->toBeString();
});

test('obExit method', function () {
	try {
		$this->utils::obExit();
		$result = 'success';
	} catch (Exception $e) {
		$result = $e->getMessage();
	}

	expect($result)->toBeSuccess();
});

test('redirectexit method', function () {
	try {
		$this->utils::redirectexit();
		$result = 'success';
	} catch (Exception $e) {
		$result = $e->getMessage();
	}

	expect($result)->toBeSuccess();
});

test('sendHttpStatus method', function () {
	try {
		$this->utils::sendHttpStatus(404);
		$result = 'success';
	} catch (Exception $e) {
		$result = $e->getMessage();
	}

	expect($result)->toBeSuccess();
});

test('shorten method', function () {
	expect($this->utils::shorten('foo'))->toBeString();
});

test('makeWritable method', function () {
	expect($this->utils::makeWritable('test.php'))->toBeTrue();
});

test('jsonDecode method', function () {
	expect($this->utils::jsonDecode('foo'))->toBeArray();
});

test('jsonEncode method', function () {
	expect($this->utils::jsonEncode('foo'))->toBe(json_encode('foo'));
});

test('htmlspecialchars method', function () {
	$source = '<a href="test">Test</a>';
	$result = htmlspecialchars($source);

	expect($this->utils::htmlspecialchars($source))->toBe($result);
});

test('htmlspecialcharsDecode method', function () {
	expect($this->utils::htmlspecialcharsDecode('foo'))->toBeString();
});

test('getMimeType method', function () {
	expect($this->utils::getMimeType('foo'))->toBeString();
});
