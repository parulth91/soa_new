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
                ->where(['id NOT IN '=> ['1','2','3','4','5','6','7']]);
        $users = $this->paginate($MyUsers,['limit'=>'2000']);

        $this->set(compact('users'));
    }
    
    public function index($id = null)
    {
     
//        $query = " select * from total_count_view";
          $connection = ConnectionManager::get('default');      
          $eventactivitylisttable = TableRegistry::get('event_activity_lists');
          $genderlisttable = TableRegistry::get('gender_lists');
           //   $Result = $eventactivitylisttable->find('all', ['contain' => ['ActivityLists'=>['game_type_lists'],
           //       'event_lists']
           //     ],
             //     'conditions' => ['is_active'=>true]]);
            $Result = $eventactivitylisttable->find()->contain([
                        'ActivityLists' => ['GameTypesLists'], 'EventLists' ])
                        ->where(['event_activity_lists.is_active' => true]);
          //  debug($Result)->toArray();die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            
               
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_by_ip'] = $_SERVER['REMOTE_ADDR'];
           // $this->request->data['dob'] = date("Y-m-d", strtotime($this->request->data['dob']));
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
               $genderfield =$genderlisttable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active'=>true])->order('description')->toArray(); 
                $this->set('genderfield',$genderfield);
               $nameResult = $Result->toArray();
              $nameResult = $this->paginate($Result);
              //debug($nameResult);die;
              $nameResult1 = $nameResult->toArray();
                //$this->set(compact($nameResult));
             $this->set('nameResult',$nameResult1);     
    }
  public function studentregister($id = null)
    {    
        $this->loadModel('Users');
        $this->loadModel('RegistercandidateEventactivity');
        $registercandentity=$this->RegistercandidateEventactivity->newEntities($this->request->data);
     //   debug($registercandentity);die;
        $user = $this->Users->newEntities($this->request->data);
     //   debug($user);die;
        $eventactivitylisttable = TableRegistry::get('event_activity_lists');
           $Result = $eventactivitylisttable->find()->contain([
                        'ActivityLists'=>['WeightCategoryLists','AgeGroupLists','GenderLists'], 'EventLists' ])
                        ->where(['event_activity_lists.is_active' => true ])->
                           where(['event_activity_lists.id'=>$id ])->toArray();
           //debug($Result);die;
                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                $created=$currentTimeStamp;   
                $modified=$currentTimeStamp;
               $event_activity_list_id=$id;
                $action_by= $_SESSION['Auth']['User']['id'];
                 $action_by_ip = $_SERVER['REMOTE_ADDR'];
                 $registration_id = rand(10,100);
                $this->set('action_by',$action_by);
                 $this->set('action_by_ip',$action_by_ip);
                  $this->set('registration_id',$registration_id);
               $this->set('created',$created);
               $this->set('modified',$modified);
               $this->set('eventactid',$event_activity_list_id);
            $this->set('Result',$Result);            
        if ($this->request->is(['patch', 'post', 'put'])) {
           // debug($this->request->getData());//die;
              //  debug($this->request->getData());die;
              //  debug($user);die;
                $registerData = [
                       'registration_id'=>$this->request->data['registration_id'],
                       'event_activity_list_id'=>$this->request->data['event_activity_list_id'],
                        'weight'               =>$this->request->data['weight'],
                         'age'                 =>$this->request->data['age']
        ];
                //  debug($registerData);die;
             $registeruser = $this->RegistercandidateEventactivity->patchEntities($registercandentity,$registerData);
           // debug($registeruser);die;
             foreach ($registeruser as $insertregisteruser) {
            // debug($this->RegistercandidateEventactivity->saveMany($insertregisteruser));
         // }
       //   die;
            if ($this->RegistercandidateEventactivity->saveMany($insertregisteruser)) {
                                           
            /*   $userData = [
                    'username' => $this->request->data['first_name'],
                     // 'password' => $this->request->data['name'],
                    'first_name' => $this->request->data['first_name'],
                    'last_name' => $this->request->data['last_name'],
                    'activation_date' =>  date('Y-m-d H:i:s'),
                    'created'         => $this->request->data['created'],
                    'modified'        => $this->request->data['modified'],
                    'active'    => 'true',
                    'role'      =>  'student',
                    'password'  =>  '123',
                    'action_by' =>   $this->request->data['action_by'],
                    'action_ip' =>    $this->request->data['action_by_ip'],   
                    'registration_id'=>$registeruser->registration_id
                ];*/
              $user = $this->Users->patchEntities($user, $this->request->getData());
             debug($user);die;
            if ($this->MyUsers->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'users_detail']);
            }
            }
           // die;
             $this->Flash->error(__('The user could not be saved. Please, try again.'));
     
           //  $this->Flash->error(__('The user could not be saved. Please, try again.'));
             $nameResult = $Result->toArray();
              $nameResult = $this->paginate($Result);
              //debug($nameResult);die;
              $nameResult1 = $nameResult->toArray();
                //$this->set(compact($nameResult));
             $this->set('nameResult',$nameResult1);
    
        }     
    }
}
}
