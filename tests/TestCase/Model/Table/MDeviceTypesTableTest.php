<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MDeviceTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MDeviceTypesTable Test Case
 */
class MDeviceTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MDeviceTypesTable
     */
    public $MDeviceTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MDeviceTypes',
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
        $config = TableRegistry::getTableLocator()->exists('MDeviceTypes') ? [] : ['className' => MDeviceTypesTable::class];
        $this->MDeviceTypes = TableRegistry::getTableLocator()->get('MDeviceTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MDeviceTypes);

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
