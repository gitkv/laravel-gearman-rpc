<?php

namespace gitkv\GearmanRpc\tests;

use gitkv\GearmanRpc\Worker;
use PHPUnit\Framework\TestCase;

class WorkerTest extends TestCase {

    protected $worker;

    public function setUp() {
        $this->worker = new Worker();
    }

    public function testAddFunction() {
        $gearmanFunctionName = 'TestFunction';
        $callback = TestRpcHandler::class;

        $this->worker->addFunction('TestFunction', $callback);

        $expectedFunctions = [
            $gearmanFunctionName => [
                'callback' => $this->worker->getClosure($callback),
            ],
        ];

        $this->assertEquals($expectedFunctions, $this->worker->getFunctions());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddFunctionThrowsExceptionIfFunctionIsAlreadyRegistered() {
        $this->worker->addFunction('TestFunction', TestRpcHandler::class);
        $this->worker->addFunction('TestFunction', TestRpcHandler::class);
    }

    public function testUnregister() {
        $gearmanFunctionName = 'TestFunction';
        $gearmanFunctionNameSecond = 'TestFunctionNew';
        $callback = TestRpcHandler::class;
        $timeout = 10;

        $this->worker
            ->addFunction($gearmanFunctionName, $callback, $timeout)
            ->addFunction($gearmanFunctionNameSecond, $callback, $timeout);

        $this->assertCount(2, $this->worker->getFunctions());

        $this->worker->unregister($gearmanFunctionName);
        $expectedFunctions = [
            $gearmanFunctionNameSecond => [
                'callback' => $this->worker->getClosure($callback),
                'timeout'  => $timeout,
            ],
        ];

        $this->assertCount(1, $this->worker->getFunctions());
        $this->assertEquals($expectedFunctions, $this->worker->getFunctions());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUnregisterThrowsExceptionIfFunctionDoesNotExist() {
        $this->worker->unregister('TestFunction');
    }

    public function testUnregisterAll() {
        $gearmanFunctionName = 'TestFunction';
        $gearmanFunctionNameSecond = 'TestFunction2';
        $callback = TestRpcHandler::class;

        $this->worker->addFunction($gearmanFunctionName, $callback);
        $this->worker->addFunction($gearmanFunctionNameSecond, $callback);

        $this->assertCount(2, $this->worker->getFunctions());

        $this->worker->unregisterAll();

        $this->assertCount(0, $this->worker->getFunctions());
    }

    public function testWorker() {
        return $this->markTestSkipped('Skipped. You can try this test on your machine with gearman running.');

        $worker = new Worker();
        $worker->addServer();
        $worker->addFunction('TestFunction', TestRpcHandler::class);

        $worker->work();
    }
}
