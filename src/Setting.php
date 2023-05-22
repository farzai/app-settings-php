<?php

namespace Farzai\AppSettings;

use Farzai\AppSettings\Contracts\StorageRepositoryInterface;
use Farzai\AppSettings\Storage\SystemTemporaryStorage;

class Setting
{
    /**
     * The storage driver.
     */
    private StorageRepositoryInterface $storage;

    /**
     * Create a new instance.
     */
    public function __construct(StorageRepositoryInterface $storage = null)
    {
        $this->storage = $storage ?: new SystemTemporaryStorage();
    }

    /**
     * Set the storage driver.
     *
     * @return $this
     */
    public function setStorage(StorageRepositoryInterface $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Get the value of the given key.
     *
     * @param  mixed  $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $value = $this->storage->get($key, $default);

        if (is_null($value)) {
            return $default;
        }

        if (is_numeric($value)) {
            return $value + 0;
        }

        if (is_string($value)) {
            if (in_array($value, ['true', 'false'])) {
                return $value === 'true';
            }

            if (in_array($value, ['null', 'NULL'])) {
                return null;
            }

            $json = @json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $json;
            }

            $unserialize = @unserialize($value);
            if ($unserialize !== false || $value === 'b:0;') {
                return $unserialize;
            }

            return $value;
        }

        return $value;
    }

    /**
     * Set the value of the given key.
     *
     * @param  mixed  $value
     * @return void
     */
    public function set(string $key, $value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        if (is_object($value)) {
            $value = serialize($value);
        }

        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            $value = 'null';
        }

        $this->storage->set($key, $value);
    }

    /**
     * Determine if the given key exists.
     */
    public function has(string $key): bool
    {
        return $this->storage->has($key);
    }

    /**
     * Remove the value of the given key.
     *
     * @return void
     */
    public function remove(string $key)
    {
        $this->storage->remove($key);
    }

    /**
     * Remove all items from the storage.
     *
     * @return void
     */
    public function clear()
    {
        $this->storage->clear();
    }
}
