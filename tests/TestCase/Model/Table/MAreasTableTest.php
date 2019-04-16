<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MAreasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MAreasTable Test Case
 */
class MAreasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MAreasTable
     */
    public $MAreas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MAreas',
        'app.MPrefectures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MAreas') ? [] : ['className' => MAreasTable::class];
        $this->MAreas = TableRegistry::getTableLocator()->get('MAreas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MAreas);

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
