<?php

namespace Ruler;

use Adbar\Dot;

/**
 * Class Context
 *
 * @package Ruler
 */
class Context implements \ArrayAccess
{
    protected $container;

    /**
     * Context constructor.
     *
     * @param array $values (default: array())
     */
    public function __construct(array $values = [])
    {
        $this->container = new Dot($values);
    }

    /**
     * Check if a key is defined into context.
     *
     * @param string $key
     *
     * @return boolean
     */
    public function offsetExists($key) : bool
    {
        return $this->container->has($key);
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
        if (! $this->offsetExists($key)) {
            throw new \InvalidArgumentException(sprintf('Key "%s" is not defined.', $key));
        }

        return $this->container->get($key);
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
        $this->container->set($key, $value);
    }

    /**
     * Unset a key-value pair
     *
     * @param string $key
     */
    public function offsetUnset($key)
    {
        $this->container->delete($key);
    }

    /**
     * Get all defined keys in context.
     *
     * @return array An array of key
     */
    public function keys() : array
    {
        return array_keys($this->container->flatten());
    }

    /**
     * @param Context $context
     * @param bool $overwrite
     */
    public function append(Context $context, bool $overwrite = false)
    {
        $this->container->merge($context->container);
    }

    /**
     * @param string $prefix
     */
    public function rekey(string $prefix)
    {
        foreach ($this->container->jsonSerialize()  as $key => $value) {
            $newKey = sprintf("%s%s", $prefix, $key);
            $value = $this->container->get($key);
            $this->offsetUnset($key);
            $this->offsetSet($newKey, $value);
        }
    }
}
