<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MUsersTable Test Case
 */
class MUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MUsersTable
     */
    public $MUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MUsers',
        'app.Centers',
        'app.Comments',
        'app.Devices',
        'app.MCustomers',
        'app.MDeviceTypes',
        'app.MOperationSystems',
        'app.MProducts',
        'app.MSqlservers',
        'app.MVersions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MUsers') ? [] : ['className' => MUsersTable::class];
        $this->MUsers = TableRegistry::getTableLocator()->get('MUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MUsers);

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
