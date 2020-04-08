<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MRolesTable Test Case
 */
class MRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MRolesTable
     */
    public $MRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MRoles',
        'app.MUsers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MRoles') ? [] : ['className' => MRolesTable::class];
        $this->MRoles = TableRegistry::getTableLocator()->get('MRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MRoles);

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
}
