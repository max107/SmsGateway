<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

interface SmsGatewayInterface
{
    /**
     * @param SmsMessageInterface $smsMessage
     *
     * @throws SmsException
     *
     * @return bool
     */
    public function send(SmsMessageInterface $smsMessage): bool;

    /**
     * @return LimitResponse
     *
     * @throws ResponseException
     */
    public function getLimit(): LimitResponse;

    /**
     * @return BalanceResponse
     *
     * @throws ResponseException
     */
    public function getBalance(): BalanceResponse;
}
