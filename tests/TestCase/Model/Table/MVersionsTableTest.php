<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MVersionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MVersionsTable Test Case
 */
class MVersionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MVersionsTable
     */
    public $MVersions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MVersions',
        'app.MUsers',
        'app.Devices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MVersions') ? [] : ['className' => MVersionsTable::class];
        $this->MVersions = TableRegistry::getTableLocator()->get('MVersions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MVersions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
