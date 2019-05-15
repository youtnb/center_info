<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomsTable Test Case
 */
class CustomsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomsTable
     */
    public $Customs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Customs',
        'app.Devices',
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
        $config = TableRegistry::getTableLocator()->exists('Customs') ? [] : ['className' => CustomsTable::class];
        $this->Customs = TableRegistry::getTableLocator()->get('Customs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Customs);

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
