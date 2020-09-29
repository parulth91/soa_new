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

    public function viewRegisteredCandidates($id = null) {
        $Result = $this->RegisterCandidates->find()->contain([
                    'EventActivityLists','StateLists','EventTeamDetails','GenderLists'
                ])
                ->where(['RegisterCandidates.event_activity_list_id' => $id]);
        //        $this->paginate = [
        //            'contain' => ['EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails']
        //        ];
        $registerCandidateEventActivities = $this->paginate($Result);
        //debug($playerTieSheets);die;
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
        $registerCandidateEventActivity = $this->RegisterCandidates->get($id, [
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
        $registerCandidateEventActivity = $this->RegisterCandidates->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $registerCandidateEventActivity = $this->RegisterCandidates->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidates->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidates->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
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
        $registerCandidateEventActivity = $this->RegisterCandidates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $registerCandidateEventActivity = $this->RegisterCandidates->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidates->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidates->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('registerCandidateEventActivity', 'eventActivityLists'));
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
        //to display team list
        $connection = ConnectionManager::get('default');
        $eventTeamlisttable = TableRegistry::get('event_team_details');
        $teamDetails = $eventTeamlisttable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['event_activity_list_id' => $id])->order('description')->toArray();
        $this->set('teamDetails', $teamDetails);

        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data);
            die;
            //if($this->request->data['view_attendance_button']=''){
            // to display registered candidate details
            $eventTeamId = $this->request->data['event_team_id'];
            //debug($eventTeamId);die;
            $registeredCandidateLists = $this->RegisterCandidates->find('all')
                    ->contain([
                        'EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists'], 'EventTeamDetails']
                    ])->where([
                        'EventActivityLists.id' => $id, 'attendance_status' => FALSE,
                        'event_team_detail_id' => $eventTeamId
                    ])
                    ->order(['RegisterCandidates.id']);
            //debug($registeredCandidateLists);die;
            $registeredCandidatePaginate = $this->paginate($registeredCandidateLists);
            $this->set(compact('registeredCandidatePaginate', '$registeredCandidatePaginate'));
            // }
            //  else{
            //for update attendance status of registered candidates

            foreach ($this->request->data['attendance_status'] as $key => $item) :
                if ($item['checkid'] != '0') {
                    $id = $item;
                    if ($id) {
                        $updateQuery = $this->RegisterCandidates->updateAll(
                                ['attendance_status ' => 'true'], ['id IN' => $id]
                        );
                    } else {
                        $this->Flash->error(__('Please select At least one.'));
                    }
                }
            endforeach;
            if ($updateQuery) {
                $this->Flash->success(__('Attendance Status has been saved .'));
                return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivtiesAttendance', $registeredCandidateLists->id]);
            } else {
                $this->Flash->error(__('The Attendance Status could not be updated. Please, try again.'));
            }
            // }
            // }
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
                    'ActivityLists' => ['GameTypeLists'], 'EventLists'
                ])
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
                        ->contain([
                            'ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
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
                // debug($data); //die;
                foreach ($data as $entityData) {
                    //debug($this->request->data[$key]); //die;
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

                    $this->request->data[$key]['event_qualifying_status'] = false;
                    $this->request->data[$key]['attendance_status'] = false;
                    $this->request->data[$key]['certificate_download_status'] = false;


                    $registration_number = $this->cList->getRegNoSeq($registering_user_state_id);
                    $this->request->data[$key]['registration_number'] = $registration_number;
                }
                // $this->request->data[$key];die;
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

                if (empty($EventTeamDetailsEntity['errors']) && empty($registerCandidateEventActivities['errors'])) {
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
                        $registerCandidateEventActivities = $this->RegisterCandidates->patchEntities($registerCandidates, $this->request->data);
                        if (empty($registerCandidateEventActivities['errors'])) {
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
                // debug($registerCandidateEventActivities);die;
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

    public function eventActivtiesTeamAttendance($id = null) {
        //to display team list
        $connection = ConnectionManager::get('default');
        $eventTeamlisttable = TableRegistry::get('event_team_details');
        $teamDetails = $eventTeamlisttable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['event_activity_list_id' => $id])->order('description')->toArray();
        $this->set('teamDetails', $teamDetails);


        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->data);die;
            //if($this->request->data['view_attendance_button']=''){
            // to display registered candidate details
            $eventTeamId = $this->request->data['event_team_id'];
            //debug($eventTeamId);die;
            $registeredCandidateLists = $this->RegisterCandidates->find('all')
                    ->contain([
                        'EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists'], 'EventTeamDetails']
                    ])->where([
                        'EventActivityLists.id' => $id,
                        'event_team_detail_id' => $eventTeamId
                    ])
                    ->order(['RegisterCandidates.id']);
            //debug($registeredCandidateLists);die;
            if (isset($registeredCandidateLists)) {
                $registeredCandidatePaginate = $this->paginate($registeredCandidateLists);
                $this->set(compact('registeredCandidatePaginate', '$registeredCandidatePaginate'));
            }
            // }
            //  else{
            if (isset($this->request->data['update_attendance_button'])) {
                //for update attendance status of registered candidates

                if (isset($this->request->data['attendance_status'])) {
                    $idChecked = '';
                    $idUnChecked = '';
                    foreach ($this->request->data['attendance_status'] as $key => $item) :
                        // debug($item);die;
                        if ($item != '0') {
                            $idChecked[] = $key;
                        } else {
                            $idUnChecked[] = $key;
                        }
                    endforeach;



                    if ($idChecked) {
                        //debug($idChecked);
                        $updateQuery = $this->RegisterCandidates->updateAll(
                                ['attendance_status ' => 'true'], ['id IN' => $idChecked]
                        );
                    }
                    if ($idUnChecked) {
                        //debug($idUnChecked);
                        $updateQuery = $this->RegisterCandidates->updateAll(
                                ['attendance_status ' => 'false'], ['id IN' => $idUnChecked]
                        );
                    }


                    $this->Flash->success(__('Attendance Status has been saved .'));
                    $registeredCandidateLists = $this->RegisterCandidates->find('all')
                            ->contain([
                                'EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists'], 'EventTeamDetails']
                            ])->where([
                                'EventActivityLists.id' => $id,
                                'event_team_detail_id' => $eventTeamId
                            ])
                            ->order(['RegisterCandidates.id']);
                    //debug($registeredCandidateLists);die;
                    if (isset($registeredCandidateLists)) {
                        $registeredCandidatePaginate = $this->paginate($registeredCandidateLists);
                        $this->set(compact('registeredCandidatePaginate', '$registeredCandidatePaginate'));
                    }
                }
                // }
                // }
            }
        }
    }

    public function eventActivtiesIndividualAttendance($id = null) {
        $registeredCandidateLists = $this->RegisterCandidates->find('all')
                ->contain(['StateLists',
                    'EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists'], 'EventTeamDetails']
                ])->where(['event_activity_list_id' => $id])
                ->order(['RegisterCandidates.state_list_id']);

        if (isset($registeredCandidateLists)) {
            $registeredCandidatePaginate = $this->paginate($registeredCandidateLists);
            $this->set(compact('registeredCandidatePaginate', '$registeredCandidatePaginate'));
        }
        //for update attendance status of registered candidates
        $idChecked = '';
        $idUnChecked = '';
        if ($this->request->is('post')) {
            //debug($this->request->data);die;
            foreach ($this->request->data['attendance_status'] as $key => $item) :
                // debug($item);die;
                if ($item != '0') {
                    $idChecked[] = $key;
                } else {
                    $idUnChecked[] = $key;
                }
            endforeach;



            if ($idChecked) {
                //debug($idChecked);
                $updateQuery = $this->RegisterCandidates->updateAll(
                        ['attendance_status ' => 'true'], ['id IN' => $idChecked]
                );
            }
            if ($idUnChecked) {
                //debug($idUnChecked);
                $updateQuery = $this->RegisterCandidates->updateAll(
                        ['attendance_status ' => 'false'], ['id IN' => $idUnChecked]
                );
            }
            return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'eventActivtiesIndividualAttendance', $id]);
        }
    }

}
