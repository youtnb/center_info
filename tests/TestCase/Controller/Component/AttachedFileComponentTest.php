<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AttachedFileComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AttachedFileComponent Test Case
 */
class AttachedFileComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\AttachedFileComponent
     */
    public $AttachedFile;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AttachedFile = new AttachedFileComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttachedFile);

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
