<?php
declare(strict_types=1);

namespace gitkv\GearmanRpc\tests;

use gitkv\GearmanRpc\Client;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase {

    private $client;

    public function setUp() {
        $this->client = new Client();
    }

    public function testClient() {
        return $this->markTestSkipped('Skipped. You can try this test on your machine with gearman running.');

        $client = new Client();
        $client->addServer();

        $testData = ['test' => 'data'];

        echo $client->doNormal('TestFunction', $testData);
        echo $client->doLow('TestFunction', $testData);
        echo $client->doHigh('TestFunction', $testData);

        $client->doBackground('TestFunction', $testData);
        $client->doHighBackground('TestFunction', $testData);
        $client->doLowBackground('TestFunction', $testData);
    }
}
