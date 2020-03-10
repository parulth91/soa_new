<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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

}
