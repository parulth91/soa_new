<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;


use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
/**
 * TeamTieSheets Controller
 *
 * @property \App\Model\Table\TeamTieSheetsTable $TeamTieSheets
 *
 * @method \App\Model\Entity\TeamTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TieSheetsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['EventTeamDetails', 'EventActivityLists']
        ];
        $teamTieSheets = $this->paginate($this->TeamTieSheets);

        $this->set(compact('teamTieSheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $teamTieSheet = $this->TeamTieSheets->get($id, [
            'contain' => ['EventTeamDetails', 'EventActivityLists']
        ]);

        $this->set('teamTieSheet', $teamTieSheet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $teamTieSheet = $this->TeamTieSheets->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $teamTieSheet = $this->TeamTieSheets->patchEntity($teamTieSheet, $this->request->getData());
            if ($this->TeamTieSheets->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $teamTieSheet = $this->TeamTieSheets->get($id, [
            //'key' => 'EventActivityListId',
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $teamTieSheet = $this->TeamTieSheets->patchEntity($teamTieSheet, $this->request->getData());
            if ($this->TeamTieSheets->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $teamTieSheet = $this->TeamTieSheets->get($id);
        if ($this->TeamTieSheets->delete($teamTieSheet)) {
            $this->Flash->success(__('The team tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The team tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function EventActivityStateList() {
        $event_activity_lists_id = $_REQUEST['event_activity_lists_id'];
        return $this->cList->ajaxGetAllEventActivityList($event_activity_lists_id);
    }

    public function tieSheet($id = null) {
        $eventActivityListTable = TableRegistry::get('event_activity_lists');
        $eventActivityLists = $eventActivityListTable->find('all')
                        ->contain(['ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
                            'EventLists','EventTeamDetails'
                        ])->where(['event_activity_lists.id' => $id])->toArray();
        debug($eventActivityLists);
        debug($id);
        die;
        if ($this->request->is('post')) {
            
        } else {

            $eventActivitiyList = $this->cList->getAllEventActivityList($event_id);
            $this->set(compact('eventActivitiyList'));
        }
    }

    public function ajaxTieSheet() {
        $this->viewBuilder()->autoLayout(false);
        $event_activity_lists_id = $_REQUEST['event_activity_lists_id'];
        $state_list_id = $_REQUEST['state_list_id'];

        $registerCandidatesTable = TableRegistry::get('RegisterCandidates');
        $registerCandidatesLists = $registerCandidatesTable->find('all')
                        ->contain(['EventActivityLists' => ['EventLists', 'ActivityLists' => ['GenderLists', 'GameTypeLists']]
                        ])->where(['EventActivityLists.id' => $event_activity_lists_id, 'state_list_id' => $state_list_id])->toArray();
//        debug($registerCandidatesLists->toArray());
//        die;
        $this->set(compact('registerCandidatesLists'));
    }

}
