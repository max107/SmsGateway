<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

class Parameters
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Parameters constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->replace($data);
    }

    /**
     * @param string $key
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public function get(string $key, $defaultValue = null)
    {
        return $this->data[$key] ?? $defaultValue;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function pop(string $key)
    {
        $value = $this->get($key);
        $this->remove($key);

        return $value;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param array $data
     */
    public function replace(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * @param string $key
     */
    public function remove(string $key)
    {
        unset($this->data[$key]);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
