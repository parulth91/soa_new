<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * EventLists Controller
 *
 * @property \App\Model\Table\EventListsTable $EventLists
 *
 * @method \App\Model\Entity\EventList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventListsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $eventLists = $this->paginate($this->EventLists);

        $this->set(compact('eventLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Event List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $eventList = $this->EventLists->get($id, [
            'contain' => []
        ]);

        $this->set('eventList', $eventList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $eventList = $this->EventLists->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $eventList = $this->EventLists->patchEntity($eventList, $this->request->getData());
            if ($this->EventLists->save($eventList)) {
                $this->Flash->success(__('The event list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event list could not be saved. Please, try again.'));
        }
        $this->set(compact('eventList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $eventList = $this->EventLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $eventList = $this->EventLists->patchEntity($eventList, $this->request->getData());
            if ($this->EventLists->save($eventList)) {
                $this->Flash->success(__('The event list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event list could not be saved. Please, try again.'));
        }
        $this->set(compact('eventList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $eventList = $this->EventLists->get($id);
        if ($this->EventLists->delete($eventList)) {
            $this->Flash->success(__('The event list has been deleted.'));
        } else {
            $this->Flash->error(__('The event list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    //method for attenance of cantididates after game start date ok
    public function attendance($id = null) {
        //debug($this->request->data);die;
        // to display registered candidate details
             $registerCandidatesTable = TableRegistry::get('RegisterCandidates');
        if ($this->request->is(['patch', 'post', 'put'])) {
            foreach($this->request->data['attendance_checkbox'] as $key=>$data){
                        debug($key);die;
                     if(!empty($key)){
                      
                      $registerCandidateid= $registerCandidatesTable->get($key);
                    }
                      //debug($registerCandidateid['can_id']);die;
            }
          
            debug($registerCandidateid);
            // $registerCandidateid=  $this->request->data('id');
            // debug($registerCandidateid);die;
            }
            if($data=='true'){
            $this->request->data['attendance_status'] = 'true';
            die;
            $attendanceStatus = $registerCandidatesTable->patchEntity($registerCandidateid,  $this->request->data);
            if ($registerCandidatesTable->save($attendanceStatus)) {
                $this->Flash->success(__('Attendance Status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            
            
            }
            $this->Flash->error(__('Attendance Status could not be saved. Please, try again.'));
        }
    



    public function result($id = null) {
        
    }

}
