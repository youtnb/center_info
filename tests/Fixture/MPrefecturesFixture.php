<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MPrefecturesFixture
 */
class MPrefecturesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '都道府県ID', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '都道府県名', 'precision' => null, 'fixed' => null],
        'm_area_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '地域ID', 'precision' => null, 'autoIncrement' => null],
        'delete_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除フラグ', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '作成日時', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '更新日時', 'precision' => null],
        '_indexes' => [
            'idx_area' => ['type' => 'index', 'columns' => ['m_area_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ip',
                'm_area_id' => 1,
                'delete_flag' => 1,
                'created' => '2019-04-16 14:01:05',
                'modified' => '2019-04-16 14:01:05'
            ],
        ];
        parent::init();
    }
}
