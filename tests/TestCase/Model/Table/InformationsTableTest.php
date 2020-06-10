<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformationsTable Test Case
 */
class InformationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InformationsTable
     */
    public $Informations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Informations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Informations') ? [] : ['className' => InformationsTable::class];
        $this->Informations = TableRegistry::getTableLocator()->get('Informations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Informations);

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
