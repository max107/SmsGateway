<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractSmsGateway implements SmsGatewayInterface
{
    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;
    /**
     * @var Parameters
     */
    protected $parameters;

    /**
     * AbstractSmsGateway constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->optionsResolver = $this->createOptionsResolver();
        $this->configureOptions($this->optionsResolver);
        $this->parameters = $this->createParameters($options);
    }

    /**
     * @return Parameters
     */
    protected function getParameters(): Parameters
    {
        return $this->parameters;
    }

    /**
     * @param array $options
     *
     * @return Parameters
     */
    private function createParameters(array $options)
    {
        return new Parameters($this->optionsResolver->resolve($options));
    }

    /**
     * @return OptionsResolver
     */
    public function createOptionsResolver(): OptionsResolver
    {
        return new OptionsResolver();
    }

    protected function configureOptions(OptionsResolver $optionsResolver)
    {
    }
}
