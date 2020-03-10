<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityList Entity
 *
 * @property int $id
 * @property string $description
 * @property int $minimum_player_participating
 * @property int $maximum_player_participating
 * @property bool $is_weight_category
 * @property int $weight_category_list_id
 * @property bool $is_active
 * @property int $action_by
 * @property \Cake\I18n\FrozenTime $created
 * @property string $action_ip
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $gender_list_id
 * @property int $game_types_lists_id
 * @property int $age_group_list_id
 *
 * @property \App\Model\Entity\WeightCategoryList $weight_category_list
 * @property \App\Model\Entity\GenderList $gender_list
 * @property \App\Model\Entity\GameTypesList $game_types_list
 * @property \App\Model\Entity\AgeGroupList $age_group_list
 */
class ActivityList extends Entity
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
        'minimum_player_participating' => true,
        'maximum_player_participating' => true,
        'is_weight_category' => true,
        'weight_category_list_id' => true,
        'is_active' => true,
        'action_by' => true,
        'created' => true,
        'action_ip' => true,
        'modified' => true,
        'gender_list_id' => true,
        'game_types_lists_id' => true,
        'age_group_list_id' => true,
        'weight_category_list' => true,
        'gender_list' => true,
        'game_types_list' => true,
        'age_group_list' => true
    ];
}
