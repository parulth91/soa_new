<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegisterCandidateEventActivity Entity
 *
 * @property int $id
 * @property int $event_activity_list_id
 * @property int $weight
 * @property int $age
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 */
class RegisterCandidate extends Entity
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
        'full_name' => true,
        'dob' => true,
        'gender_list_id' => true,
        'registration_number' => true,
        'event_team_detail_id' => true,
        'weight' => true,
        'age' => true,
        'event_qualifying_status' => true,
        'attendance_status' => true,
        'certificate_download_status' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'state_list_id' => true,
        'event_activity_list' => true,
        'gender_list' => true,
        'event_team_detail' => true,
        'state_list' => true
    ];
}
