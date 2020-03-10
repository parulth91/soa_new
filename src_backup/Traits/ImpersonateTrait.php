<?php
namespace App\Controller\Traits;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Impersonate Trait
 */
trait ImpersonateTrait
{
    /**
     * Adding a new feature as an example: Impersonate another user
     *
     * @param type $userId
     */
    public function impersonate($userId)
    {
        $user = $this->getUsersTable()->find()
                ->where(['id' => $userId])
                ->hydrate(false)
                ->first();
        $this->Auth->setUser($user);
        return $this->redirect('/');
    }
}