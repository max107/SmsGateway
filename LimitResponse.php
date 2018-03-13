<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Max107\SmsGateway;

class LimitResponse
{
    /**
     * @var int
     */
    protected $current;
    /**
     * @var int
     */
    protected $total;

    public function __construct(int $current, int $total)
    {
        $this->current = $current;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }
}
