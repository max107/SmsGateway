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
    protected $text;

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
            } else {
                throw new \RuntimeException(sprintf(
                    'Unknown property: %s',
                    $key
                ));
            }
        }
    }

    /**
     * @param string $to
     *
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = (string)$to;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = (string)$text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return (string)$this->text;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return (string)$this->to;
    }
}
