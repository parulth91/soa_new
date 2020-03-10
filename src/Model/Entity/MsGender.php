<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MsGender Entity
 *
 * @property int $id
 * @property string $description
 * @property int $point_assigned
 * @property bool $is_active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $action_ip
 *
 * @property \App\Model\Entity\EmployeeInformation[] $employee_informations
 */
class MsGender extends Entity
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
        'point_assigned' => true,
        'is_active' => true,
        'action_by' => true,
        'created' => true,
        'modified' => true,
        'action_ip' => true,
        'employee_informations' => true
    ];
}
