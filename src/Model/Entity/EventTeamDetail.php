<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventTeamDetail Entity
 *
 * @property int $id
 * @property string $description
 * @property int $event_activity_list_id
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $state_list_id
 * @property bool $active
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 * @property \App\Model\Entity\RegisterCandidateEventActivity[] $register_candidate_event_activities
 */
class EventTeamDetail extends Entity
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
        'event_activity_list_id' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'state_list_id' => true,
        'active' => true,
        'event_activity_list' => true,
        'register_candidate_event_activities' => true,
        'register_candidates' => true
    ];
}
