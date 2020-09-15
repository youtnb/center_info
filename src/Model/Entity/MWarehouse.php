<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MWarehouse Entity
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property int|null $center_id_1
 * @property int|null $center_id_2
 * @property int|null $center_id_3
 * @property int|null $center_id_4
 * @property int|null $center_id_5
 * @property string|null $remarks
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MUser $m_user
 */
class MWarehouse extends Entity
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
        'icon' => true,
        'center_id_1' => true,
        'center_id_2' => true,
        'center_id_3' => true,
        'center_id_4' => true,
        'center_id_5' => true,
        'remarks' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'm_user' => true
    ];
}
