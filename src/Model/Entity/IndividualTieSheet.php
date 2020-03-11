<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IndividualTieSheet Entity
 *
 * @property int $id
 * @property int $register_candidate_event_activity_id
 * @property int $opponent_register_candidate_event_activity_id
 * @property int $match_number
 * @property int $winner_register_candidate_event_activity_id
 * @property int $event_activity_list_id
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RegisterCandidateEventActivity $register_candidate_event_activity
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 */
class IndividualTieSheet extends Entity
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
        'register_candidate_event_activity_id' => true,
        'opponent_register_candidate_event_activity_id' => true,
        'match_number' => true,
        'winner_register_candidate_event_activity_id' => true,
        'event_activity_list_id' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'register_candidate_event_activity' => true,
        'event_activity_list' => true
    ];
}
