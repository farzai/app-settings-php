<?php

namespace Farzai\AppSettings\Contracts;

interface StorageRepositoryInterface
{
    /**
     * Get the value of the given key.
     *
     * @param  mixed  $default
     */
    public function get(string $key, $default = null): ?string;

    /**
     * Set the value of the given key.
     *
     * @param  mixed  $value
     * @return void
     */
    public function set(string $key, string $value);

    /**
     * Determine if the given key exists.
     */
    public function has(string $key): bool;

    /**
     * Remove the value of the given key.
     *
     * @return void
     */
    public function remove(string $key);

    /**
     * Remove all items from the storage.
     *
     * @return void
     */
    public function clear();
}
