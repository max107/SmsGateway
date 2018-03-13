<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway\Tests\Gateway;

use Max107\SmsGateway\Gateway\SmsRuGateway;
use Max107\SmsGateway\SmsMessage;
use PHPUnit\Framework\TestCase;

class SmsRuGatewayTest extends TestCase
{
    public function testSmsRu()
    {
        $smsru = $this->getMockBuilder(SmsRuGateway::class)
            ->disableOriginalConstructor()
            ->getMock();
        $smsru->method('send')->willReturn(true);

        $msg = new SmsMessage([
            'to' => '123',
            'text' => '123'
        ]);
        $this->assertTrue($smsru->send($msg));
    }
}
