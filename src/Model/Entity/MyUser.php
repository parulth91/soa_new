<?php
namespace App\Model\Entity;

use CakeDC\Users\Model\Entity\User;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\Utility\Security;
/**
 * Application specific User Entity with non plugin conform field(s)
 */
class MyUser extends User
{
    
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'is_superuser' => false,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
        'token_expires',
        'api_token',
    ];

    /**
     * @param string $password password that will be set.
     * @return bool|string
     */
    protected function _setPassword($password)
    {
        return $this->hashPassword($password);
    }

    /**
     * @param string $password password that will be confirm.
     * @return bool|string
     */
    protected function _setConfirmPassword($password)
    {
        return $this->hashPassword($password);
    }

    /**
     * @param string $tos tos option. It will be set the tos_date
     * @return bool
     */
    protected function _setTos($tos)
    {
        if ((bool)$tos === true) {
            $this->set('tos_date', Time::now());
        }

        return $tos;
    }

    /**
     * Hash a password using the configured password hasher,
     * use DefaultPasswordHasher if no one was configured
     *
     * @param string $password password to be hashed
     * @return mixed
     */
    public function hashPassword($password)
    {
        $PasswordHasher = $this->getPasswordHasher();

        return $PasswordHasher->hash($password);
    }

    /**
     * Return the configured Password Hasher
     *
     * @return mixed
     */
    public function getPasswordHasher()
    {
        $passwordHasher = Configure::read('Users.passwordHasher');
        if (!class_exists($passwordHasher)) {
            $passwordHasher = '\Cake\Auth\DefaultPasswordHasher';
        }

        return new $passwordHasher;
    }

    /**
     * Checks if a password is correctly hashed
     *
     * @param string $password password that will be check.
     * @param string $hashedPassword hash used to check password.
     * @return bool
     */
    public function checkPassword($password, $hashedPassword)
    {
        $PasswordHasher = $this->getPasswordHasher();

        return $PasswordHasher->check($password, $hashedPassword);
    }

    /**
     * Returns if the token has already expired
     *
     * @return bool
     */
    public function tokenExpired()
    {
        if (empty($this->token_expires)) {
            return true;
        }

        return new Time($this->token_expires) < Time::now();
    }

    /**
     * Getter for user avatar
     *
     * @return string|null avatar
     */
    protected function _getAvatar()
    {
        $avatar = null;
        if (!empty($this->_properties['social_accounts'][0])) {
            $avatar = $this->_properties['social_accounts'][0]['avatar'];
        }

        return $avatar;
    }

    /**
     * Generate token_expires and token in a user
     * @param int $tokenExpiration seconds to expire the token from Now
     * @return void
     */
    public function updateToken($tokenExpiration = 0)
    {
        $expiration = new Time('now');
        $this->token_expires = $expiration->addSeconds($tokenExpiration);
        $this->token = bin2hex(Security::randomBytes(16));
    }
}
