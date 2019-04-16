<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MProductsTable Test Case
 */
class MProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MProductsTable
     */
    public $MProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MProducts',
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
        $config = TableRegistry::getTableLocator()->exists('MProducts') ? [] : ['className' => MProductsTable::class];
        $this->MProducts = TableRegistry::getTableLocator()->get('MProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MProducts);

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
