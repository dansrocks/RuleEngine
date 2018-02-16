<?php

namespace Ruler;

/**
 * Class Context
 *
 * @package Ruler
 */
class Context implements \ArrayAccess
{
    private $keys   = [];
    private $values = [];

    /**
     * Context constructor.
     *
     * @param array $values (default: array())
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Check if a keyname is defined into context.
     *
     * @param string $name
     *
     * @return boolean
     */
    public function offsetExists($name) : bool
    {
        return isset($this->keys[$name]);
    }

    /**
     * Get the key-value in context
     *
     * @param string $key
     *
     * @return mixed The resolved value of the fact
     *
     * @throws \InvalidArgumentException if the key is not defined
     */
    public function offsetGet($key)
    {
        if (!$this->offsetExists($key)) {
            throw new \InvalidArgumentException(sprintf('Key "%s" is not defined.', $key));
        }

        return $this->values[$key];
    }

    /**
     * Set a value into a fact (associated with a key).
     *
     * @param string $key  Unique key for the fact
     *
     * @param mixed  $value The value or a closure to lazily define the value
     */
    public function offsetSet($key, $value)
    {
        $this->keys[$key]   = true;
        $this->values[$key] = $value;
    }

    /**
     * Unset a key-value pair
     *
     * @param string $key
     */
    public function offsetUnset($key)
    {
        if ($this->offsetExists($key)) {
            unset($this->keys[$key], $this->values[$key]);
        }
    }

    /**
     * Get all defined keys in context.
     *
     * @return array An array of key
     */
    public function keys()
    {
        return array_keys($this->keys);
    }
}
