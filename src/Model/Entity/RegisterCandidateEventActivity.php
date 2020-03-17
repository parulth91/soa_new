<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegisterCandidateEventActivity Entity
 *
 * @property int $id
 * @property int $event_activity_list_id
 * @property string $full_name
 * @property \Cake\I18n\FrozenDate $dob
 * @property int $gender_list_id
 * @property string $registration_number
 * @property int $event_team_detail_id
 * @property int $weight
 * @property int $age
 * @property bool $event_qualifying_status
 * @property bool $attendance_status
 * @property bool $certificate_download_status
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $state_list_id
 * @property int $result_status_list_id
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 * @property \App\Model\Entity\GenderList $gender_list
 * @property \App\Model\Entity\EventTeamDetail $event_team_detail
 * @property \App\Model\Entity\StateList $state_list
 */
class RegisterCandidateEventActivity extends Entity
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
        'result_status_list_id' => true,
        'event_activity_list' => true,
        'gender_list' => true,
        'event_team_detail' => true,
        'state_list' => true
    ];
}
