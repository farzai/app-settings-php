<?php

use Farzai\AppSettings\Storage\SystemTemporaryStorage;

beforeEach(function () {
    $storage = new SystemTemporaryStorage();

    $storage->clear();
});

it('can get the value of the given key', function () {
    $storage = new SystemTemporaryStorage();
    $storage->set('foo', 'bar');

    expect($storage->get('foo'))->toBe('bar');
});

it('can get the value of the given key with default value', function () {
    $storage = new SystemTemporaryStorage();

    expect($storage->get('foo', 'bar'))->toBe('bar');
});

it('can set the value of the given key', function () {
    $storage = new SystemTemporaryStorage();
    $storage->set('foo', 'bar');

    expect($storage->get('foo'))->toBe('bar');
});

it('can determine if the given key exists', function () {
    $storage = new SystemTemporaryStorage();
    $storage->set('foo', 'bar');

    expect($storage->has('foo'))->toBeTrue();
    expect($storage->has('bar'))->toBeFalse();
});

it('can remove the value of the given key', function () {
    $storage = new SystemTemporaryStorage();
    $storage->set('foo', 'bar');
    $storage->remove('foo');

    expect($storage->has('foo'))->toBeFalse();
});
