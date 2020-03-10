<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CountryList Entity
 *
 * @property int $id
 * @property string $description
 * @property string $country_code
 * @property string $flag_code
 * @property string $telephone_code
 * @property bool $is_active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\StateList[] $state_lists
 */
class CountryList extends Entity
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
        'country_code' => true,
        'flag_code' => true,
        'telephone_code' => true,
        'is_active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'state_lists' => true
    ];
}
