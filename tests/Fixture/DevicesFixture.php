<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DevicesFixture
 */
class DevicesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '端末ID', 'autoIncrement' => true, 'precision' => null],
        'center_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '拠点ID', 'precision' => null, 'autoIncrement' => null],
        'm_device_type_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '端末種別ID', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '端末名称', 'precision' => null, 'fixed' => null],
        'ip_higher' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '上位IP', 'precision' => null, 'fixed' => null],
        'ip_lower' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '下位IP', 'precision' => null, 'fixed' => null],
        'reserve_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '予備機フラグ', 'precision' => null],
        'security_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'セキュリティソフトフラグ', 'precision' => null],
        'model' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '型式', 'precision' => null, 'fixed' => null],
        'serial_no' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '製造番号', 'precision' => null, 'fixed' => null],
        'support_end_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '保守終了日', 'precision' => null],
        'setup_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '設置日', 'precision' => null],
        'm_operation_system_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'OS種別ID', 'precision' => null, 'autoIncrement' => null],
        'm_sqlserver_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'SQLServer種別ID', 'precision' => null, 'autoIncrement' => null],
        'admin_pass' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Administratorパスワード', 'precision' => null, 'fixed' => null],
        'm_product_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '製造種別ID', 'precision' => null, 'autoIncrement' => null],
        'm_version_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'バージョン種別ID', 'precision' => null, 'autoIncrement' => null],
        'custom' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '改造内容', 'precision' => null],
        'connect' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '接続先', 'precision' => null, 'fixed' => null],
        'remote' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'リモート接続方法', 'precision' => null, 'fixed' => null],
        'remarks' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '備考', 'precision' => null],
        'running_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '稼働フラグ', 'precision' => null],
        'delete_flag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除フラグ', 'precision' => null],
        'm_user_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '更新者ID', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '作成日時', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '更新日時', 'precision' => null],
        '_indexes' => [
            'idx_center' => ['type' => 'index', 'columns' => ['center_id'], 'length' => []],
            'idx_type' => ['type' => 'index', 'columns' => ['m_device_type_id'], 'length' => []],
            'idx_delete' => ['type' => 'index', 'columns' => ['id'], 'length' => []],
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
                'center_id' => 1,
                'm_device_type_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'ip_higher' => 'Lorem ipsum d',
                'ip_lower' => 'Lorem ipsum d',
                'reserve_flag' => 1,
                'security_flag' => 1,
                'model' => 'Lorem ipsum dolor sit amet',
                'serial_no' => 'Lorem ipsum dolor sit amet',
                'support_end_date' => '2019-04-16',
                'setup_date' => '2019-04-16',
                'm_operation_system_id' => 1,
                'm_sqlserver_id' => 1,
                'admin_pass' => 'Lorem ipsum dolor sit amet',
                'm_product_id' => 1,
                'm_version_id' => 1,
                'custom' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'connect' => 'Lorem ipsum dolor sit amet',
                'remote' => 'Lorem ipsum dolor sit amet',
                'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'running_flag' => 1,
                'delete_flag' => 1,
                'm_user_id' => 1,
                'created' => '2019-04-16 15:48:21',
                'modified' => '2019-04-16 15:48:21'
            ],
        ];
        parent::init();
    }
}
