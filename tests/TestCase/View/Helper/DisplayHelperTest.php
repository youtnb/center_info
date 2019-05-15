<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\DisplayHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\DisplayHelper Test Case
 */
class DisplayHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\DisplayHelper
     */
    public $Display;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Display = new DisplayHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Display);

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
