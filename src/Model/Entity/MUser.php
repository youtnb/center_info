<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MUser Entity
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property bool $delete_flag
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MUser[] $m_users
 * @property \App\Model\Entity\Center[] $centers
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Device[] $devices
 * @property \App\Model\Entity\MCustomer[] $m_customers
 * @property \App\Model\Entity\MDeviceType[] $m_device_types
 * @property \App\Model\Entity\MOperationSystem[] $m_operation_systems
 * @property \App\Model\Entity\MProduct[] $m_products
 * @property \App\Model\Entity\MSqlserver[] $m_sqlservers
 * @property \App\Model\Entity\MVersion[] $m_versions
 */
class MUser extends Entity
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
        'name' => true,
        'login' => true,
        'password' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'm_users' => true,
        'centers' => true,
        'comments' => true,
        'devices' => true,
        'm_customers' => true,
        'm_device_types' => true,
        'm_operation_systems' => true,
        'm_products' => true,
        'm_sqlservers' => true,
        'm_versions' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
