<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Center Entity
 *
 * @property int $id
 * @property int $m_customer_id
 * @property string $name
 * @property string|null $postcode
 * @property int|null $m_prefecture_id
 * @property string|null $address
 * @property string|null $tel
 * @property string|null $officer
 * @property string|null $staff
 * @property string|null $access
 * @property string|null $map
 * @property string|null $job
 * @property string|null $remarks
 * @property bool $thermo_dry_flag
 * @property bool $thermo_chilled_flag
 * @property bool $thermo_frozen_flag
 * @property bool $shoes_flag
 * @property bool $delete_flag
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MCustomer $m_customer
 * @property \App\Model\Entity\MPrefecture $m_prefecture
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Device[] $devices
 */
class Center extends Entity
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
        'm_customer_id' => true,
        'name' => true,
        'postcode' => true,
        'm_prefecture_id' => true,
        'address' => true,
        'tel' => true,
        'officer' => true,
        'staff' => true,
        'access' => true,
        'map' => true,
        'job' => true,
        'remarks' => true,
        'thermo_dry_flag' => true,
        'thermo_chilled_flag' => true,
        'thermo_frozen_flag' => true,
        'shoes_flag' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'm_customer' => true,
        'm_prefecture' => true,
        'm_user' => true,
        'devices' => true
    ];
}
