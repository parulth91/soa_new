<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventActivityList Entity
 *
 * @property int $id
 * @property string $description
 * @property bool $is_active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property int $event_lists_id
 * @property int $activity_lists_id
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventList $event_list
 * @property \App\Model\Entity\ActivityList $activity_list
 */
class EventActivityList extends Entity
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
        'event_lists_id' => true,
        'activity_lists_id' => true,
        'modified' => true,
        'event_list' => true,
        'activity_list' => true
    ];
}
