<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * MUser Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $m_department_id
 * @property int $m_role_id
 * @property bool $delete_flag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MDepartment $m_department
 * @property \App\Model\Entity\MRole $m_role
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
        'email' => true,
        'password' => true,
        'm_department_id' => true,
        'm_role_id' => true,
        'delete_flag' => true,
        'created' => true,
        'modified' => true,
        'm_department' => true,
        'm_role' => true,
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

    /**
     * パスワードハッシュ化
     * @param type $password
     * @return type
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
