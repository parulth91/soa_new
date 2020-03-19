<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeamMyTieSheet Entity
 *
 * @property int $id
 * @property int $event_activity_list_id
 * @property int $round_number
 * @property string $round_description
 * @property int $match_number
 * @property int $team1_event_team_detail_id
 * @property int $team2_event_team_detail_id
 * @property int $team1_score
 * @property int $team2_score
 * @property int $winner_team_detail_id
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 * @property \App\Model\Entity\EventTeamDetail $event_team_detail
 */
class MyTeam extends Entity {

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
        'team1_score' => true,
        'team2_score' => true,
        'winner_event_team_detail_id' => true,
        'match_number' => true,
        'team1_event_team_detail_id' => true,
        'team2_event_team_detail_id' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'event_activity_list' => true,
        'winner_event_team_detail' => true,
        'team1_event_team_detail' => true,
        'team2_event_team_detail' => true
    ];

}
