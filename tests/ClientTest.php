<?php

namespace Smooch\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSendMessage()
    {
        $expectedResponse = json_encode(
            array(
                'message' => array(
                    '_id' => 'MESSAGE_ID',
                    'text' => 'MESSAGE',
                    'role' => 'appMaker'
                )
            )
        );

        $mock = $this->getMockBuilder('Smooch\Client')
            ->getMock();
        $mock
            ->method('request')
            ->willReturn($expectedResponse);

        $message = new Smooch\Model\Message([
            'text' => 'MESSAGE_CONTENT',
            'role' => 'appMaker'
        ]);
        $mock->setCredentials("SECRET", "KEY_ID");

        $response = $mock
            ->getAppUser('USER_ID_OR_SMOOCH_ID')
            ->conversation
            ->add($message);

        $this->assertEquals($expectedResponse, $response->getPayload());
    }

    public function testUnauthorizedClientRequest()
    {
        try {
            $message = new Smooch\Model\Message([
                'text' => 'MESSAGE_CONTENT',
                'role' => 'appMaker'
            ]);

            $smoochClient = new Smooch\Client();
            $smoochClient->setCredentials("FAKE_SECRET", "FAKE_KEY_ID");

            $smoochClient
                ->getAppUser('USER_ID_OR_SMOOCH_ID')
                ->conversation
                ->add($message);
        } catch (\Exception $ex) {
            $this->assertEquals($ex->getCode(), 401);
        }
    }
}