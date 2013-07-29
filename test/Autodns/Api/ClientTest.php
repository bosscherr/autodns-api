<?php

use Autodns\Api\Client\Method\Provider;
use Autodns\Api\XmlDelivery;

class ClientTest extends TestCase
{
    const SOME_URL = 'some url';

    const SOME_METHOD_NAME = 'some method name';

    /**
     * @var Provider | TestDataBuilder_StubBuilder | PHPUnit_Framework_MockObject_MockObject
     */
    private $methodProvider;

    /**
     * @var XmlDelivery | TestDataBuilder_StubBuilder | PHPUnit_Framework_MockObject_MockObject
     */
    private $delivery;

    protected function setUp()
    {
        parent::setUp();

        $this->methodProvider = $this->aStub('Autodns\Api\Client\Method\Provider')
            ->with('fetchMethod', $this->aMethod());
        $this->delivery = $this->aStub('Autodns\Api\XmlDelivery');
    }

    /**
     * @test
     */
    public function itShouldFetchTheMethodByTheMethodName()
    {
        $methodName = self::SOME_METHOD_NAME;

        $this->methodProvider = $this->methodProvider->build();
        $this->methodProvider
            ->expects($this->once())
            ->method('fetchMethod')
            ->with($methodName);

        $this->buildClient()->call($methodName, self::SOME_URL, $this->somePayload());
    }

    /**
     * @test
     */
    public function itShouldCreateATaskWithTheFetchedMethod()
    {
        $payload = $this->somePayload();

        $method = $this->aMethod()->build();
        $method
            ->expects($this->once())
            ->method('createTask')
            ->with($payload);

        $this->methodProvider->with('fetchMethod', $method);

        $this->buildClient()->call(self::SOME_METHOD_NAME, self::SOME_URL, $payload);
    }

    /**
     * @test
     */
    public function itShouldSendTheRequestToTheGivenUrl()
    {
        $url = self::SOME_URL;

        $this->delivery = $this->delivery->build();
        $this->delivery
            ->expects($this->once())
            ->method('send')
            ->with($url, $this->anything());

        $this->buildClient()->call(self::SOME_METHOD_NAME, $url, $this->somePayload());
    }

    /**
     * @test
     */
    public function itShouldReturnTheResponseFromTheDelivery()
    {
        $response = 'some response';

        $this->delivery->with('send', $response);

        $this->assertSame($response, $this->buildClient()->call(self::SOME_METHOD_NAME, self::SOME_URL, $this->somePayload()));
    }

    /**
     * @return \Autodns\Api\Client
     */
    private function buildClient()
    {
        return $this->anObject('\Autodns\Api\Client')
            ->with(
                array(
                    $this->methodProvider,
                    $this->delivery
                )
            )->build();
    }

    private function somePayload()
    {
        return array();
    }

    /**
     * @return TestDataBuilder_StubBuilder
     */
    private function aMethod()
    {
        return $this->aStub('Autodns\Api\Client\Method')->with('createTask', array());
    }

    private function someRequest()
    {
        return array();
    }
}