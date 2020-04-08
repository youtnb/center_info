<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MCustomer Entity
 *
 * @property int $id
 * @property string $name
 * @property string $full_name
 * @property string|null $remarks
 * @property bool $delete_flag
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Center[] $centers
 */
class MCustomer extends Entity
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
        'full_name' => true,
        'remarks' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'm_user' => true,
        'centers' => true
    ];
}
