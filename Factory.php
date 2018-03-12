<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

class Factory
{
    /**
     * @var SmsRegistry
     */
    protected $smsRegistry;

    /**
     * Factory constructor.
     *
     * @param SmsRegistry $smsRegistry
     */
    public function __construct(SmsRegistry $smsRegistry)
    {
        $this->smsRegistry = $smsRegistry;
    }

    /**
     * @param string $gateway
     * @param array  $parameters
     *
     * @return SmsGatewayInterface
     */
    public function createGateway(string $gateway, array $parameters = []): SmsGatewayInterface
    {
        $class = $this->smsRegistry->getGateway($gateway);

        return new $class($parameters);
    }
}
