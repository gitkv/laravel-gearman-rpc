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

        echo $client->doNormal('replace', 'java is best programming language!');
        echo $client->doLow('replace', 'java is best programming language!');
        echo $client->doHigh('replace', 'java is best programming language!');

        $client->doBackground('long_task', 'java java java java');
        $client->doHighBackground('long_task', 'java java java java');
        $client->doLowBackground('long_task', 'java java java java');
    }
}
