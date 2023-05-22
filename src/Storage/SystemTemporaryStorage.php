<?php

namespace Farzai\AppSettings\Storage;

use Farzai\AppSettings\Contracts\StorageRepositoryInterface;

class SystemTemporaryStorage implements StorageRepositoryInterface
{
    /**
     * The path to the storage.
     */
    private string $path;

    /**
     * Create a new instance.
     */
    public function __construct(string $prefix = '')
    {
        $hash = base64_encode(dirname(dirname(__DIR__)));

        $this->path = sys_get_temp_dir().DIRECTORY_SEPARATOR.$prefix.$hash;
    }

    /**
     * Get the value of the given key.
     *
     * @param  mixed  $default
     */
    public function get(string $key, $default = null): ?string
    {
        $value = $this->read($key);

        if ($value === false) {
            return $default;
        }

        return $value;
    }

    /**
     * Set the value of the given key.
     *
     * @param  mixed  $value
     * @return void
     */
    public function set(string $key, string $value)
    {
        $this->write($key, $value);
    }

    /**
     * Determine if the given key exists.
     */
    public function has(string $key): bool
    {
        return $this->read($key) !== false;
    }

    /**
     * Remove the value of the given key.
     *
     * @return void
     */
    public function remove(string $key)
    {
        $this->write($key, null);
    }

    /**
     * Remove all items from the storage.
     *
     * @return void
     */
    public function clear()
    {
        $this->deleteDirectory($this->path);

        if (file_exists($this->path)) {
            rmdir($this->path);
        }
    }

    /**
     * Read the value of the given key.
     *
     * @return string|false
     */
    private function read(string $key)
    {
        $path = $this->path.DIRECTORY_SEPARATOR.$key;

        if (! file_exists($path)) {
            return false;
        }

        return file_get_contents($path);
    }

    /**
     * Write the value of the given key.
     *
     * @return void
     */
    private function write(string $key, ?string $value)
    {
        $path = $this->path.DIRECTORY_SEPARATOR.$key;

        if ($value === null) {
            if (file_exists($path)) {
                unlink($path);
            }

            return;
        }

        if (! file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }

        file_put_contents($path, $value);
    }

    /**
     * Delete the given directory.
     *
     * @return void
     */
    private function deleteDirectory(string $path)
    {
        if (! file_exists($path)) {
            return;
        }

        $files = array_diff(scandir($path), ['.', '..']);

        foreach ($files as $file) {
            $file = $path.DIRECTORY_SEPARATOR.$file;

            if (is_dir($file)) {
                $this->deleteDirectory($file);
            } else {
                unlink($file);
            }
        }
    }
}
