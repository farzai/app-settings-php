<?php

use Farzai\AppSettings\Setting;

beforeEach(function () {
    $this->setting = new Setting();

    $this->setting->clear();
});

it('can get the value of the given key', function () {
    $this->setting->set('foo', 'bar');

    expect($this->setting->get('foo'))->toBe('bar');
});

it('can get the value of the given key with default value', function () {
    expect($this->setting->get('name', 'Farzai'))->toBe('Farzai');
});

it('can set the value of the given key', function () {
    $this->setting->set('foo', 'bar');

    expect($this->setting->get('foo'))->toBe('bar');
});

it('can determine if the given key exists', function () {
    $this->setting->set('foo', 'bar');

    expect($this->setting->has('foo'))->toBeTrue();
    expect($this->setting->has('bar'))->toBeFalse();
});

it('can remove the value of the given key', function () {
    $this->setting->set('foo', 'bar');
    $this->setting->remove('foo');

    expect($this->setting->has('foo'))->toBeFalse();
});

it('can clear all items from the storage', function () {
    $this->setting->set('foo', 'bar');
    $this->setting->set('bar', 'baz');

    expect($this->setting->has('foo'))->toBeTrue();
    expect($this->setting->has('bar'))->toBeTrue();

    $this->setting->clear();

    expect($this->setting->has('foo'))->toBeFalse();
    expect($this->setting->has('bar'))->toBeFalse();
});

it('can set boolean value', function () {
    $this->setting->set('boolean', true);

    expect($this->setting->get('boolean'))->toBe(true);
});

it('can set integer value', function () {
    $this->setting->set('integer', 1);

    expect($this->setting->get('integer'))->toBe(1);
});

it('can set float value', function () {
    $this->setting->set('float', 1.1);

    expect($this->setting->get('float'))->toBe(1.1);
});

it('can set null value', function () {
    $this->setting->set('null', null);

    expect($this->setting->get('null'))->toBeNull();
});

it('can set array value', function () {
    $this->setting->set('array', [
        'foo' => 'bar',
        'bar' => 'baz',
    ]);

    expect($this->setting->get('array'))->toBe([
        'foo' => 'bar',
        'bar' => 'baz',
    ]);
});
