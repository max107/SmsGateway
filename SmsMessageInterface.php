<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

interface SmsMessageInterface
{
    /**
     * @return string
     */
    public function getTo(): string;

    /**
     * @param int|string $to
     */
    public function setTo($to);

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @param string $text
     */
    public function setText($text);
}
