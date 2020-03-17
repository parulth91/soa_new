<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventActivityList Entity
 *
 * @property int $id
 * @property string $description
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property int $event_lists_id
 * @property int $activity_lists_id
 * @property \Cake\I18n\FrozenTime $modified
 * @property float $registration_fees
 *
 * @property \App\Model\Entity\EventList $event_list
 * @property \App\Model\Entity\ActivityList $activity_list
 * @property \App\Model\Entity\EventTeamDetail[] $event_team_details
 * @property \App\Model\Entity\RegisterCandidateEventActivity[] $register_candidate_event_activities
 * @property \App\Model\Entity\RegisterCandidate[] $register_candidates
 * @property \App\Model\Entity\TeamTieSheet[] $team_tie_sheets
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
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'event_lists_id' => true,
        'activity_lists_id' => true,
        'modified' => true,
        'registration_fees' => true,
        'event_list' => true,
        'activity_list' => true,
        'event_team_details' => true,
        'register_candidate_event_activities' => true,
        'register_candidates' => true,
        'team_tie_sheets' => true
    ];
}
