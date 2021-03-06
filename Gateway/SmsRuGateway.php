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
use Max107\SmsGateway\ResponseException;
use Max107\SmsGateway\BalanceResponse;
use Max107\SmsGateway\LimitResponse;
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

    public function __construct(array $options)
    {
        parent::__construct($options);

        $this->api = $this->createApiClient();
    }

    /**
     * @return Api
     */
    protected function createApiClient(): Api
    {
        $token = $this->getParameters()->get('api_token');

        return new Api(new ApiIdAuth($token));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver
            ->setDefaults([
                // На пиво разработчику
                'partner_id' => 153212,
                'translit' => false,
                'test' => false,
            ])
            ->setRequired(['api_token']);
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
        if (100 === (int)$response->code) {
            return true;
        }

        throw new SmsException($response->getDescription());
    }

    /**
     * @param SmsMessageInterface $smsMessage
     *
     * @return Sms
     */
    protected function convertSmsMessage(SmsMessageInterface $smsMessage): Sms
    {
        $sms = new Sms($smsMessage->getTo(), $smsMessage->getText());

        $sms->test = $this->parameters->get('test');
        $sms->translit = $this->parameters->get('translit');
        $sms->partner_id = $this->parameters->get('partner_id');

        return $sms;
    }

    /**
     * {@inheritdoc}
     */
    public function getBalance(): BalanceResponse
    {
        try {
            $balance = $this->api->myBalance();

            return new BalanceResponse(
                (float)$balance->balance
            );
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit(): LimitResponse
    {
        try {
            $response = $this->api->request('my/limit');
            list($limit, $current) = explode("\n", $response);

            return new LimitResponse(
                (int)$current,
                (int)$limit
            );
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }
}
