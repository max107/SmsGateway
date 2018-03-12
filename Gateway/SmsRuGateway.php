<?php

declare(strict_types=1);

/*
 * Maxim Falaleev (c) 2010-2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\SmsGateway\Gateway;

use Max107\SmsGateway\AbstractSmsGateway;
use Max107\SmsGateway\SmsException;
use Max107\SmsGateway\SmsGatewayInterface;
use Max107\SmsGateway\SmsMessageInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zelenin\SmsRu\Api;
use Zelenin\SmsRu\Auth\ApiIdAuth;
use Zelenin\SmsRu\Entity\Sms;

class SmsRuGateway extends AbstractSmsGateway implements SmsGatewayInterface
{
    /**
     * @var Api
     */
    protected $api;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options)
    {
        parent::__construct($options);

        $token = $this->getParameters()->get('api_token');
        if (empty($token)) {
            throw new \RuntimeException('Api token cannot be empty');
        }
        $this->api = new Api(new ApiIdAuth($token));
    }

    protected function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setRequired(['api_token']);
    }

    /**
     * @param SmsMessageInterface $smsMessage
     *
     * @throws \Zelenin\SmsRu\Exception\Exception
     * @throws SmsException
     *
     * @return bool
     */
    public function send(SmsMessageInterface $smsMessage): bool
    {
        $response = $this->api->smsSend($this->convertSmsMessage($smsMessage));
        if (100 === (int) $response->code) {
            return true;
        }

        throw new SmsException($response->getDescription());
    }

    protected function convertSmsMessage(SmsMessageInterface $smsMessage): Sms
    {
        return new Sms($smsMessage->getTo(), $smsMessage->getMessage());
    }
}
