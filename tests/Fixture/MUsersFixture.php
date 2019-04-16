<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MUsersFixture
 */
class MUsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ユーザーID', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '名前', 'precision' => null, 'fixed' => null],
        'login' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'ログイン', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'パスワード', 'precision' => null, 'fixed' => null],
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
                'name' => 'Lorem ipsum dolor sit amet',
                'login' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'delete_flag' => 1,
                'm_user_id' => 1,
                'created' => '2019-04-16 14:55:22',
                'modified' => '2019-04-16 14:55:22'
            ],
        ];
        parent::init();
    }
}
