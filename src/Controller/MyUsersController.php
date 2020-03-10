<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Controller\Traits\LinkSocialTrait;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use CakeDC\Users\Controller\Traits\ReCaptchaTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
use CakeDC\Users\Controller\Traits\SocialTrait;
use Cake\Datasource\ConnectionManager;

class MyUsersController extends AppController {

    use LinkSocialTrait;
    use LoginTrait;
    use ProfileTrait;
    use ReCaptchaTrait;
    use RegisterTrait;
    use SimpleCrudTrait;
    use SocialTrait;

//add your new actions, override, etc here

    public function add() {
        $user = $this->MyUsers->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_by_ip'] = $_SERVER['REMOTE_ADDR'];
            $user = $this->MyUsers->patchEntity($user, $this->request->getData());
            if ($this->MyUsers->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $msCountries = $this->MyUsers->MsCountries->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        $msStates = $this->MyUsers->MsStates->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        $msDistricts = $this->MyUsers->MsDistricts->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        $availabilities = $this->MyUsers->Availabilities->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        $this->set(compact('user', 'msCountries', 'msStates', 'msDistricts', 'availabilities'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->MyUsers->get($id);
        if ($this->MyUsers->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function view($id = null) {
        $user = $this->MyUsers->get($id, [
            'contain' => ['Availabilities', 'SocialAccounts', 'UserContributionTypes', 'UserGroupRoles', 'UserRoles', 'UserTasks']
        ]);

        $this->set('user', $user);
    }

    public function editUsers($id = null) {
        $user = $this->MyUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_by_ip'] = $_SERVER['REMOTE_ADDR'];
            $this->request->data['dob'] = date("Y-m-d", strtotime($this->request->data['dob']));
            $this->request->data['activation_date'] = date('Y-m-d H:i:s');
            $user = $this->MyUsers->patchEntity($user, $this->request->getData());
            $this->log($user);
            //debug($user);die;
            if ($this->MyUsers->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'users_detail']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    public function usersDetail($id = null) {
//        $this->paginate = [
//            'contain' => []
//        ];
        $MyUsers = $this->MyUsers->find('all')
                ->where(['id NOT IN ' => ['1', '2', '3', '4', '5', '6', '7']]);
        $users = $this->paginate($MyUsers, ['limit' => '2000']);

        $this->set(compact('users'));
    }

    public function index() {
        
    }

  

}
