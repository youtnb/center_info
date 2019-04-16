<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MPrefecturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MPrefecturesTable Test Case
 */
class MPrefecturesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MPrefecturesTable
     */
    public $MPrefectures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MPrefectures',
        'app.MAreas',
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
        $config = TableRegistry::getTableLocator()->exists('MPrefectures') ? [] : ['className' => MPrefecturesTable::class];
        $this->MPrefectures = TableRegistry::getTableLocator()->get('MPrefectures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MPrefectures);

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
