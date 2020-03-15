<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StateList Entity
 *
 * @property int $id
 * @property string $description
 * @property int $country_list_id
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CountryList $country_list
 * @property \App\Model\Entity\DistrictList[] $district_lists
 * @property \App\Model\Entity\EventTeamDetail[] $event_team_details
 * @property \App\Model\Entity\RegisterCandidateEventActivity[] $register_candidate_event_activities
 */
class StateList extends Entity
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
        'country_list_id' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'country_list' => true,
        'district_lists' => true,
        'event_team_details' => true,
        'register_candidate_event_activities' => true,
        'register_candidates' => true
    ];
}
