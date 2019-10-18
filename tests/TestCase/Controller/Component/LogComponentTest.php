<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\LogComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\LogComponent Test Case
 */
class LogComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\LogComponent
     */
    public $Log;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Log = new LogComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Log);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
