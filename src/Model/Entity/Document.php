<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity
 *
 * @property int $id
 * @property int $center_id
 * @property int $device_id
 * @property string $file_name
 * @property string $file_path
 * @property string|null $remarks
 * @property int $delete_flag
 * @property int $m_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Center $center
 * @property \App\Model\Entity\Device $device
 * @property \App\Model\Entity\MUser $m_user
 */
class Document extends Entity
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
        'device_id' => true,
        'file_name' => true,
        'file_path' => true,
        'remarks' => true,
        'delete_flag' => true,
        'm_user_id' => true,
        'created' => true,
        'modified' => true,
        'center' => true,
        'device' => true,
        'm_user' => true
    ];
}
