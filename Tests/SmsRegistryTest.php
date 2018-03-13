<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Max107\SmsGateway\Tests;

use Max107\SmsGateway\SmsGatewayInterface;
use Max107\SmsGateway\SmsRegistry;
use PHPUnit\Framework\TestCase;

class SmsRegistryTest extends TestCase
{
    public function testSmsRegistry()
    {
        $gateway = $this->getMockBuilder(SmsGatewayInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $registry = new SmsRegistry([
            'sms_ru' => $gateway
        ]);
        $this->assertCount(1, $registry->getGateways());
    }
}
