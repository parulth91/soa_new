<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * RegisterCandidateEventActivities Controller
 *
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable $RegisterCandidateEventActivities
 *
 * @method \App\Model\Entity\RegisterCandidateEventActivity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegisterCandidatesController extends AppController {

    public function viewAll($id = null) {

//        $query = " select * from total_count_view";
        $connection = ConnectionManager::get('default');
        $eventactivitylisttable = TableRegistry::get('event_activity_lists');
        $genderlisttable = TableRegistry::get('gender_lists');
        //   $Result = $eventactivitylisttable->find('all', ['contain' => ['ActivityLists'=>['game_type_lists'],
        //       'event_lists']
        //     ],
        //     'conditions' => ['is_active'=>true]]);
        $Result = $eventactivitylisttable->find()->contain([
                    'ActivityLists' => ['GameTypeLists'], 'EventLists'])
                ->where(['event_activity_lists.active' => true]);
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
        $genderfield = $genderlisttable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description')->toArray();
        $this->set('genderfield', $genderfield);
        $nameResult = $Result->toArray();
        $nameResult = $this->paginate($Result);
        //debug($nameResult);die;
        $nameResult1 = $nameResult->toArray();
        //$this->set(compact($nameResult));
        $this->set('nameResult', $nameResult1);
    }

    public function register($id = null) {
        $this->loadModel('Users');
        $this->loadModel('RegistercandidateEventactivity');
        $registercandentity = $this->RegistercandidateEventactivity->newEntities($this->request->data);
        //   debug($registercandentity);die;
        $user = $this->Users->newEntities($this->request->data);
        //   debug($user);die;
        $eventactivitylisttable = TableRegistry::get('event_activity_lists');
        $Result = $eventactivitylisttable->find()->contain([
                            'ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists'], 'EventLists'])
                        ->where(['event_activity_lists.active' => true])->
                        where(['event_activity_lists.id' => $id])->toArray();
        //debug($Result);die;
        $currentTimeStamp = Time::now();
        $currentTimeStamp->i18nFormat();
        $created = $currentTimeStamp;
        $modified = $currentTimeStamp;
        $event_activity_list_id = $id;
        $action_by = $_SESSION['Auth']['User']['id'];
        $action_by_ip = $_SERVER['REMOTE_ADDR'];
        $registration_id = rand(10, 100);
        $this->set('action_by', $action_by);
        $this->set('action_by_ip', $action_by_ip);
        $this->set('registration_id', $registration_id);
        $this->set('created', $created);
        $this->set('modified', $modified);
        $this->set('eventactid', $event_activity_list_id);
        $this->set('Result', $Result);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());//die;
            //  debug($this->request->getData());die;
            //  debug($user);die;
            $registerData = [
                'registration_id' => $this->request->data['registration_id'],
                'event_activity_list_id' => $this->request->data['event_activity_list_id'],
                'weight' => $this->request->data['weight'],
                'age' => $this->request->data['age']
            ];
            //  debug($registerData);die;
            $registeruser = $this->RegistercandidateEventactivity->patchEntities($registercandentity, $registerData);
            //debug($registeruser);die;
            foreach ($registeruser as $insertregisteruser) {
                $this->RegistercandidateEventactivity->saveMany($insertregisteruser);
            }
            die;
            if ($this->RegistercandidateEventactivity->save($registeruser)) {

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
                  ]; */
                $user = $this->Users->patchEntity($user, $userData);
                debug($user);
                die;
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
            $this->set('nameResult', $nameResult1);
        }
    }

    public function studentRegister($id = null) {
        // to display some fields from eventactivities  table
        $eventActivityListTable = TableRegistry::get('event_activity_lists');
        $eventActivityLists = $eventActivityListTable->find('all')
                        ->contain(['ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists','GameTypeLists'],
                            'EventLists'
                        ])->where(['event_activity_lists.id' => $id]);

        //debug($_SESSION['Auth']['User']);
        $eventActivityListsArray = $eventActivityLists->toArray();
        $age_calculation_end_date = $eventActivityListsArray[0]->event_list->event_start_date;
        $mimimum_age = $eventActivityListsArray[0]->activity_list->age_group_list->minimum_age;
        $maximum_age = $eventActivityListsArray[0]->activity_list->age_group_list->maximum_age;
        //        debug($eventActivityListsArray[0]->activity_list->age_group_list->minimum_age);
        //        debug($eventActivityListsArray[0]->activity_list->age_group_list->maximum_age);
        //        debug($eventActivityListsArray[0]);
        // die;
        
        $registring_user_state_id=$_SESSION['Auth']['User']['state_list_id'];
        if ($this->request->is('post')) {       
            debug($this->request->data);
            foreach ($this->request->data as $key => $data) {
                foreach ($data as $entityData) {
                    //$dateOfBirth = "17-10-1985";
                    // $today = date("Y-m-d");
                    debug($data['dob']);
                    $age = date_diff(date_create($data['dob']), date_create($age_calculation_end_date))->format('%y');
                   
                    if ($age <= $mimimum_age || $age >= $maximum_age) {
                        debug($age);
                        die;
                        $this->Flash->error(__('Age of candidate '.$data['full_name'].' should me between minimum and maximum age of acivity.'));
                        return $this->redirect(['controller' => 'RegisterCandidates','action' => 'student_register',$id]);
                    }
                    // die;
                    //debug($entityData);
                    $this->request->data[$key]['age'] = $age;
                    $this->request->data[$key]['event_activity_list_id'] = $id;
                    $this->request->data[$key]['state_list_id'] = $registring_user_state_id;
                    $this->request->data[$key]['action_by'] = $_SESSION['Auth']['User']['id'];
                    $this->request->data[$key]['action_ip'] = $_SERVER['REMOTE_ADDR'];
                    $this->request->data[$key]['active'] = true;
                                            $registration_number=$this->cList->getRegNoSeq($registring_user_state_id);
                    $this->request->data[$key]['registration_number'] = $registration_number;
                }
            }
            debug($this->request->data);
            die;
            $registerCandidates = $this->RegisterCandidates->newEntities($this->request->data);
            $registerCandidateEventActivities = $this->RegisterCandidates->patchEntities($registerCandidates, $this->request->data);
            $result = $this->RegisterCandidates->saveMany($registerCandidateEventActivities);
            debug($result);
            debug($registerCandidateEventActivities);
            debug($this->request->data);
            die;
            $registerCandidateEventActivity = $this->RegisterCandidates->patchEntity($registerCandidate, $this->request->getData());
            debug($registerCandidateEventActivity);
            die;
            if ($this->RegisterCandidates->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }


       //debug($eventActivityListsArray[0]->activity_list->gender_list->description);die;
       if($eventActivityListsArray[0]->activity_list->gender_list->description == 'Neutral'){
           $genderLists = $this->RegisterCandidates->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])
                   ->where(['active' => true,'id !=' =>'3'])
                   ->order('description');
       }else{
           $genderLists = $this->RegisterCandidates->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])
                   ->where(['active' => true,'id' =>$eventActivityListsArray[0]->activity_list->gender_list->id])
                   ->order('description');
       }
        $this->set(compact('eventActivityLists', 'genderLists'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['EventActivityLists']
        ];
        $registerCandidateEventActivities = $this->paginate($this->RegisterCandidates);

        $this->set(compact('registerCandidateEventActivities'));
    }

    /**
     * View method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id, [
            'contain' => ['EventActivityLists']
        ]);

        $this->set('registerCandidateEventActivity', $registerCandidateEventActivity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidateEventActivities->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidateEventActivities->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('registerCandidateEventActivity', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidateEventActivities->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidateEventActivities->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('registerCandidateEventActivity', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id);
        if ($this->RegisterCandidateEventActivities->delete($registerCandidateEventActivity)) {
            $this->Flash->success(__('The register candidate event activity has been deleted.'));
        } else {
            $this->Flash->error(__('The register candidate event activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    //method for attenance of cantididates after game start date ok
    public function attendance($id=null){
        
    }
    public function tieSheet($id=null){
        
    }
    public function result($id=null){
        
    }

}
