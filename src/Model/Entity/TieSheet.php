<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeamTieSheet Entity
 *
 * @property int $id
 * @property int $event_team_detail_id
 * @property int $opponent_event_team_detail_id
 * @property int $match_number
 * @property int $winner_team_detail_id
 * @property int $event_activity_list_id
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventTeamDetail $event_team_detail
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 */
class TieSheet extends Entity
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
        'event_team_detail_id' => true,
        'opponent_event_team_detail_id' => true,
        'match_number' => true,
        'winner_team_detail_id' => true,
        'event_activity_list_id' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'event_team_detail' => true,
        'event_activity_list' => true
    ];
}
