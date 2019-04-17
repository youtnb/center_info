<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MDepartmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MDepartmentsTable Test Case
 */
class MDepartmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MDepartmentsTable
     */
    public $MDepartments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MDepartments',
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
        $config = TableRegistry::getTableLocator()->exists('MDepartments') ? [] : ['className' => MDepartmentsTable::class];
        $this->MDepartments = TableRegistry::getTableLocator()->get('MDepartments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MDepartments);

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
