<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

interface SmsPoolInterface
{
    /**
     * @return \Generator
     */
    public function getMessages(): \Generator;
}
