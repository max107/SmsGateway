<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway\Tests;

use Max107\SmsGateway\SmsMessage;
use PHPUnit\Framework\TestCase;

class SmsMessageTest extends TestCase
{
    public function testSmsMessage()
    {
        $msg = new SmsMessage([
            'to' => 123,
            'text' => '123'
        ]);
        $this->assertSame('123', $msg->getTo());
        $this->assertSame('123', $msg->getText());
    }
}
