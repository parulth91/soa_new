<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $token
 * @property \Cake\I18n\FrozenTime $token_expires
 * @property string $api_token
 * @property \Cake\I18n\FrozenTime $activation_date
 * @property \Cake\I18n\FrozenTime $tos_date
 * @property bool $active
 * @property bool $is_superuser
 * @property string $role
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $secret
 * @property bool $secret_verified
 * @property \Cake\I18n\FrozenDate $dob
 * @property float $phone_no
 * @property int $action_by
 * @property string $action_ip
 * @property bool $password_changed
 * @property int $registration_id
 *
 * @property \App\Model\Entity\SocialAccount[] $social_accounts
 */
class User extends Entity
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
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'tos_date' => true,
        'active' => true,
        'is_superuser' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'secret' => true,
        'secret_verified' => true,
        'dob' => true,
        'phone_no' => true,
        'action_by' => true,
        'action_ip' => true,
        'password_changed' => true,
        'social_accounts' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];
}
