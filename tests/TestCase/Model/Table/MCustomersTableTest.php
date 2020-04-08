<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MCustomersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MCustomersTable Test Case
 */
class MCustomersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MCustomersTable
     */
    public $MCustomers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MCustomers',
        'app.MUsers',
        'app.Centers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MCustomers') ? [] : ['className' => MCustomersTable::class];
        $this->MCustomers = TableRegistry::getTableLocator()->get('MCustomers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MCustomers);

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

    /**
     * Test beforeFind method
     *
     * @return void
     */
    public function testBeforeFind()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
