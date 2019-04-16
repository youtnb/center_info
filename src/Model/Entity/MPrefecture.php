<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MPrefecture Entity
 *
 * @property int $id
 * @property string $name
 * @property int $m_area_id
 * @property bool $delete_flag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\MArea $m_area
 * @property \App\Model\Entity\Center[] $centers
 */
class MPrefecture extends Entity
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
        'm_area_id' => true,
        'delete_flag' => true,
        'created' => true,
        'modified' => true,
        'm_area' => true,
        'centers' => true
    ];
}
