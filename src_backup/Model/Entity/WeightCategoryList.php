<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WeightCategoryList Entity
 *
 * @property int $id
 * @property string $description
 * @property bool $is_active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $maximum_weight
 * @property int $minimum_weight
 *
 * @property \App\Model\Entity\ActivityList[] $activity_lists
 */
class WeightCategoryList extends Entity
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
        'description' => true,
        'is_active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'maximum_weight' => true,
        'minimum_weight' => true,
        'activity_lists' => true
    ];
}
