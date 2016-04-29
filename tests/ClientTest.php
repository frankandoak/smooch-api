<?php

namespace Smooch\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testUnauthorizedClientSendMessage()
    {
        try {
            $message = new \Smooch\Model\Message([
                'text' => 'MESSAGE_CONTENT',
                'role' => 'appMaker'
            ]);

            $smoochClient = new \Smooch\Client();
            $smoochClient->setCredentials('FAKE_SECRET', 'FAKE_KEY_ID');

            $smoochClient
                ->getAppUser('USER_ID_OR_SMOOCH_ID')
                ->conversation
                ->add($message);
        } catch (\Exception $ex) {
            $this->assertEquals($ex->getCode(), 401);
        }
    }

    public function testAuthorizedClientSendMessage()
    {
        $expectedClientResponse = [
            'message' => [
                '_id' => 'MESSAGE_ID',
                'text' => 'MESSAGE',
                'role' => 'appMaker'
            ]
        ];

        $mock = $this->getMockBuilder('\Smooch\Client')
            ->getMock();
        $mock
            ->method('request')
            ->willReturn($expectedClientResponse);
        $mock
            ->method('getAppUser')
            ->willReturn(new \Smooch\AppUser($mock, 'USER_ID_OR_SMOOCH_ID'));

        $message = new \Smooch\Model\Message([
            'text' => 'MESSAGE_CONTENT',
            'role' => 'appMaker'
        ]);
        $mock->setCredentials('SECRET', 'KEY_ID');

        $response = $mock
            ->getAppUser('USER_ID_OR_SMOOCH_ID')
            ->conversation
            ->add($message);

        $this->assertInstanceOf('Smooch\Model\Message', $response);
    }
}