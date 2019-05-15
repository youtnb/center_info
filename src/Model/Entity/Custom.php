<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Custom Entity
 *
 * @property int $id
 * @property int $device_id
 * @property string|null $accepted_no
 * @property string|null $content
 * @property bool $delete_flag
 * @property int|null $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Device $device
 * @property \App\Model\Entity\MUser $m_user
 */
class Custom extends Entity
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
        'device_id' => true,
        'accepted_no' => true,
        'content' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'device' => true,
        'm_user' => true
    ];
}
