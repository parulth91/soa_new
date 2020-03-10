<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventList Entity
 *
 * @property int $event_year
 * @property string $description
 * @property \Cake\I18n\FrozenTime $registration_start_date
 * @property \Cake\I18n\FrozenTime $registration_end_date
 * @property \Cake\I18n\FrozenTime $event_start_date
 * @property \Cake\I18n\FrozenTime $event_end_date
 * @property bool $active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $id
 */
class EventList extends Entity
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
        'event_year' => true,
        'description' => true,
        'registration_start_date' => true,
        'registration_end_date' => true,
        'event_start_date' => true,
        'event_end_date' => true,
        'active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true
    ];
}
