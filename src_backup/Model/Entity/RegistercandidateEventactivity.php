<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegistercandidateEventactivity Entity
 *
 * @property int $registration_id
 * @property int $event_activity_list_id
 * @property int $weight
 * @property int $age
 *
 * @property \App\Model\Entity\EventActivityList $event_activity_list
 */
class RegistercandidateEventactivity extends Entity
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
        'registration_id' => true,
        'event_activity_list_id' => true,
        'weight' => true,
        'age' => true,
        'event_activity_list' => true
    ];
}
