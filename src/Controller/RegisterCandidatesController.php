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

//    public function eventActivtiesAttendance($event_id = null) {
//        if ($this->request->is('post')) {
//            
//        } else {
//
//            $eventActivitiyList = $this->cList->getAllEventActivityList($event_id);
//            $this->set(compact('eventActivitiyList'));
//        }
//    }

    public function EventActivityStateList() {
        $event_activity_lists_id = $_REQUEST['event_activity_lists_id'];
        return $this->cList->ajaxGetAllEventActivityList($event_activity_lists_id);
    }

    public function eventActivtiesAttendance($id = null) {

        // to display registered candidate details
        $registeredCandidateLists = $this->RegisterCandidates->find('all')
                        ->contain(['EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists']]
                        ])->where(['EventActivityLists.id' => $id]);

        $registeredCandidatePaginate = $this->paginate($registeredCandidateLists);
        $this->set(compact('registeredCandidatePaginate', '$registeredCandidatePaginate'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registerCandidateid = $this->RegisterCandidates->get($id);
            //debug($id);
            // $registerCandidateid=  $this->request->data('id');
            // debug($registerCandidateid);die;

            $this->request->data['attendance_status'] = 'true';
            $attendanceStatus = $this->RegisterCandidates->patchEntity($registerCandidateid, $this->request->getData());
            if ($this->RegisterCandidates->save($attendanceStatus)) {
                $this->Flash->success(__('Attendance Status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Attendance Status could not be saved. Please, try again.'));
        }
    }

    public function viewEventActivities($id = null) {

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
                ->where(['event_activity_lists.active' => true, 'event_lists_id' => $id]);
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

    public function eventActivitiesStudentRegister($id = null) {
        //  debug($this->request->data);die;
        // to display some fields from eventactivities  table
        $eventActivityListTable = TableRegistry::get('event_activity_lists');
        $eventActivityLists = $eventActivityListTable->find('all')
                        ->contain(['ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
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

        $registering_user_state_id = $_SESSION['Auth']['User']['state_list_id'];
        if ($this->request->is('post')) {

            //  debug($this->request->data);die;
            if (!empty($this->request->data['EventTeamDetails'])) {
                $EventTeamDetails = $this->request->data['EventTeamDetails'];
                unset($this->request->data['EventTeamDetails']);
            } else {
                $EventTeamDetails = null;
            }
            foreach ($this->request->data as $key => $data) {
                foreach ($data as $entityData) {
                    $age = date_diff(date_create($data['dob']), date_create($age_calculation_end_date))->format('%y');
                    if ((int) $age < $mimimum_age || $age > $maximum_age) {
                        $this->Flash->error(__('Age of candidate ' . $data['full_name'] . 'of Age ' . $age . ' should me between minimum and maximum age of acivity.'));
                        return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $id]);
                    }
                    $this->request->data[$key]['dob'] = date("Y-m-d", strtotime($this->request->data[$key]['dob']));
                    $this->request->data[$key]['age'] = $age;
                    $this->request->data[$key]['event_activity_list_id'] = $id;
                    $this->request->data[$key]['state_list_id'] = $registering_user_state_id;
                    $this->request->data[$key]['action_by'] = $_SESSION['Auth']['User']['id'];
                    $this->request->data[$key]['action_ip'] = $_SERVER['REMOTE_ADDR'];
                    $this->request->data[$key]['active'] = true;
                    $registration_number = $this->cList->getRegNoSeq($registering_user_state_id);
                    $this->request->data[$key]['registration_number'] = $registration_number;
                }
            }

            //register candidates check
            $registerCandidates = $this->RegisterCandidates->newEntities($this->request->data);
            $registerCandidateEventActivities = $this->RegisterCandidates->patchEntities($registerCandidates, $this->request->data);

            //event team detals entiity creation for insertion
            if (!empty($EventTeamDetails)) {

                $EventTeamDetails['event_activity_list_id'] = $id;
                $EventTeamDetails['state_list_id'] = $registering_user_state_id;
                $EventTeamDetails['action_by'] = $_SESSION['Auth']['User']['id'];
                $EventTeamDetails['action_ip'] = $_SERVER['REMOTE_ADDR'];
                $EventTeamDetails['active'] = true;
                $eventTeamDetailsTable = TableRegistry::get('EventTeamDetails');
                $eventTeamDetailsTableEntity = $eventTeamDetailsTable->newEntity();
                $EventTeamDetailsEntity = $eventTeamDetailsTable->patchEntity($eventTeamDetailsTableEntity, $EventTeamDetails);
//                debug($EventTeamDetails);

                if (empty($EventTeamDetailsEntity['errors']) && empty($EventTeamDetailsEntity['errors'])) {
//                    debug($EventTeamDetailsEntity);
//                    debug($registerCandidateEventActivities);
//                    die;
                    $result = $eventTeamDetailsTable->save($EventTeamDetailsEntity);
//                    debug($result);
//                        debug($EventTeamDetailsEntity);
//                        debug($registerCandidateEventActivities);
//                        die;
                    if ($result) {
                        
                        $eventTeamDetailId = $result->id;
                        foreach ($this->request->data as $key => $data) {
                            foreach ($data as $entityData) {
                                $this->request->data[$key]['event_team_detail_id'] = $eventTeamDetailId;
                            }
                        }
                        $registerCandidates = $this->RegisterCandidates->newEntities($this->request->data);
                        $EventTeamDetailsEntity = $eventTeamDetailsTable->patchEntity($eventTeamDetailsTableEntity, $EventTeamDetails);
                        if (empty($EventTeamDetailsEntity['errors'])) {
                            if ($this->RegisterCandidates->saveMany($registerCandidateEventActivities)) {
                                $this->Flash->success(__('The register candidate event activity has been saved.'));
                                return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $id]);
                            }
                        }
                    }
                } else {
                    $this->Flash->error(__('The register candidate event activity could not be saved. Please, check data and try again.'));
                    return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $id]);
                }
            } else {
                if ($this->RegisterCandidates->saveMany($registerCandidateEventActivities)) {
                    $this->Flash->success(__('The register candidate event activity has been saved.'));
                    return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $id]);
                } else {
                    $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
                }
            }
            return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $id]);
        }


        //debug($eventActivityListsArray[0]->activity_list->gender_list->description);die;
        if ($eventActivityListsArray[0]->activity_list->gender_list->description == 'Neutral') {
            $genderLists = $this->RegisterCandidates->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])
                    ->where(['active' => true, 'id !=' => '3'])
                    ->order('description');
        } else {
            $genderLists = $this->RegisterCandidates->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])
                    ->where(['active' => true, 'id' => $eventActivityListsArray[0]->activity_list->gender_list->id])
                    ->order('description');
        }
        $this->set(compact('eventActivityLists', 'genderLists'));
    }

}
