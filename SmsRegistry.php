<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

class SmsRegistry
{
    protected $gateways = [];

    /**
     * SmsRegistry constructor.
     *
     * @param array $gateways
     */
    public function __construct(array $gateways)
    {
        $this->setGateways($gateways);
    }

    /**
     * @param array|SmsGatewayInterface[] $gateways
     */
    public function setGateways(array $gateways)
    {
        $this->gateways = $gateways;
    }

    public function getGateways(): array
    {
        return $this->gateways;
    }

    /**
     * @param string              $name
     * @param SmsGatewayInterface $gateway
     */
    public function addGateway(string $name, SmsGatewayInterface $gateway)
    {
        $this->gateways[$name] = $gateway;
    }

    /**
     * @param string $gateway
     *
     * @return SmsGatewayInterface
     */
    public function getGateway(string $gateway): SmsGatewayInterface
    {
        if (array_key_exists($gateway, $this->gateways)) {
            return $this->gateways[$gateway];
        }

        throw new \RuntimeException(sprintf(
            'Unknown gateway: %s',
            $gateway
        ));
    }
}
