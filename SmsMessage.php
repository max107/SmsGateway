<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

class SmsMessage implements SmsMessageInterface
{
    /**
     * @var string
     */
    protected $to;
    /**
     * @var string
     */
    protected $message;

    /**
     * SmsMessage constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            $method = sprintf('set%s', ucfirst($key));
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }

    /**
     * @param string $to
     *
     * @return $this
     */
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return (string) $this->message;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return (string) $this->to;
    }
}
