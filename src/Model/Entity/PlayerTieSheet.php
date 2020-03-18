<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlayerTieSheet Entity
 *
 * @property int $id
 * @property int $event_activity_list_id
 * @property int $round_number
 * @property string $round_description
 * @property int $player1_score
 * @property int $player2_score
 * @property int $winner_register_candidate_event_activity_id
 * @property int $match_number
 * @property int $player1_register_candidate_event_activity_id
 * @property int $player2_register_candidate_event_activity_id
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 * @property \App\Model\Entity\WinnerRegisterCandidateEventActivity $winner_register_candidate_event_activity
 * @property \App\Model\Entity\Player1RegisterCandidateEventActivity $player1_register_candidate_event_activity
 * @property \App\Model\Entity\Player2RegisterCandidateEventActivity $player2_register_candidate_event_activity
 */
class PlayerTieSheet extends Entity
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
        'event_activity_list_id' => true,
        'round_number' => true,
        'round_description' => true,
        'player1_score' => true,
        'player2_score' => true,
        'winner_register_candidate_event_activity_id' => true,
        'match_number' => true,
        'player1_register_candidate_event_activity_id' => true,
        'player2_register_candidate_event_activity_id' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'event_activity_list' => true,
        'winner_register_candidate_event_activity' => true,
        'player1_register_candidate_event_activity' => true,
        'player2_register_candidate_event_activity' => true
    ];
}
