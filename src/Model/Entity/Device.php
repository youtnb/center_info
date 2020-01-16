<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Device Entity
 *
 * @property int $id
 * @property int $center_id
 * @property int $m_device_type_id
 * @property string|null $accepted_no
 * @property string|null $name
 * @property string|null $ip_higher
 * @property string|null $ip_lower
 * @property bool $reserve_flag
 * @property int $security_flag
 * @property string|null $model
 * @property string|null $serial_no
 * @property \Cake\I18n\FrozenDate|null $support_end_date
 * @property \Cake\I18n\FrozenDate|null $setup_date
 * @property int|null $m_operation_system_id
 * @property int|null $m_sqlserver_id
 * @property string|null $admin_pass
 * @property int|null $m_product_id
 * @property int|null $m_version_id
 * @property string|null $custom
 * @property string|null $connect
 * @property string|null $remote
 * @property string|null $remarks
 * @property bool $running_flag
 * @property bool $delete_flag
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Center $center
 * @property \App\Model\Entity\MDeviceType $m_device_type
 * @property \App\Model\Entity\MOperationSystem $m_operation_system
 * @property \App\Model\Entity\MSqlserver $m_sqlserver
 * @property \App\Model\Entity\MProduct $m_product
 * @property \App\Model\Entity\MVersion $m_version
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Custom[] $customs
 */
class Device extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'center_id' => true,
        'm_device_type_id' => true,
        'accepted_no' => true,
        'name' => true,
        'ip_higher' => true,
        'ip_lower' => true,
        'reserve_flag' => true,
        'security_flag' => true,
        'model' => true,
        'serial_no' => true,
        'support_end_date' => true,
        'setup_date' => true,
        'm_operation_system_id' => true,
        'm_sqlserver_id' => true,
        'admin_pass' => true,
        'm_product_id' => true,
        'm_version_id' => true,
        'custom' => true,
        'connect' => true,
        'remote' => true,
        'remarks' => true,
        'running_flag' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'center' => true,
        'm_device_type' => true,
        'm_operation_system' => true,
        'm_sqlserver' => true,
        'm_product' => true,
        'm_version' => true,
        'm_user' => true,
        'comments' => true,
        'customs' => true
    ];
}
