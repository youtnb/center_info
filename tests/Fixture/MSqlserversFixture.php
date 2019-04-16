<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MSqlserversFixture
 */
class MSqlserversFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'SQLServer種別ID', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '名称', 'precision' => null, 'fixed' => null],
        'background_color' => ['type' => 'string', 'length' => 7, 'null' => false, 'default' => '#000000', 'collate' => 'utf8_unicode_ci', 'comment' => '背景色', 'precision' => null, 'fixed' => null],
        'sort' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '並び順', 'precision' => null, 'autoIncrement' => null],
        'delete_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除フラグ', 'precision' => null],
        'm_user_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '更新者ID', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '作成日時', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '更新日時', 'precision' => null],
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
                'name' => 'Lorem ipsum dolor ',
                'background_color' => 'Lorem',
                'sort' => 1,
                'delete_flag' => 1,
                'm_user_id' => 1,
                'created' => '2019-04-16 14:55:08',
                'modified' => '2019-04-16 14:55:08'
            ],
        ];
        parent::init();
    }
}
