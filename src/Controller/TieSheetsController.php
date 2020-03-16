<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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

    public function tieSheet($event_id = null) {





        if ($this->request->is('post')) {
            $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
            $options = ['EmployeeInformations.ms_rank_id' => $this->request->data['ms_rank_id'],
                'EmployeeInformations.ms_cadre_id' => $this->request->data['ms_cadre_id'],
                'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
            if ($this->request->data['list_type_id'] == '0') {
                //$options['whether_couple_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '1') {
                $options['whether_terminal_case'] = FALSE;
                $options['whether_unfit_for_haa_cold_climate'] = FALSE;
                $options['whether_couple_case'] = FALSE;
                $options['whether_medical_ground_case'] = FALSE;
                $options['whether_compassionate_case'] = FALSE;
            }
            if ($this->request->data['list_type_id'] == '2') {
                $options['whether_terminal_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '3') {
                $options['whether_unfit_for_haa_cold_climate'] = true;
            }
            if ($this->request->data['list_type_id'] == '4') {
                $options['whether_couple_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '5') {
                $options['whether_medical_ground_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '6') {
                $options['whether_compassionate_case'] = true;
            }


            if ($this->request->data['btn'] == 'SHOW LIST') {
                //debug($options);
                $jebLists = $this->getJebDataForAllocataion($options);
            }
            if ($this->request->data['btn'] == 'Update Transfer Out') {
                $jebLists = $this->getJebDataForAllocataion($options);
                $this->cList->updateTransferOutVacancyAll($this->request->data['ms_rank_id'], $this->request->data['ms_cadre_id']);
            }
            if ($this->request->data['btn'] == 'Assign Points') {

                //database for point assignment
                $connection = ConnectionManager::get('default');
                $tableGeneration = "select * from assign_points(" . $this->request->data['ms_rank_id'] . "," . $this->request->data['ms_cadre_id'] . "," . $this->request->data['list_type_id'] . ")";
                // debug($tableGeneration);
                $connection->execute($tableGeneration);
                //return $connection;
//                $jebLists = $this->getJebDataForAllocataion($options);
//                foreach ($jebLists as $jebList) {
//                    $this->cList->assignPointsToEmployee($jebList->regimental_number);
//                }
                //$jebLists = $this->getJebDataForAllocataion($options);
            }




            if ($this->request->data['btn'] == 'Allocate Unit') {
                //debug($this->request->data['list_type_id']);
                $connection = ConnectionManager::get('default');
                $tableGeneration = "select * from allocate_unit(" . $this->request->data['ms_rank_id'] . "," . $this->request->data['ms_cadre_id'] . "," . $this->request->data['list_type_id'] . ")";
                //debug($tableGeneration);
                $connection->execute($tableGeneration);
            }

            $jebLists = $this->getJebDataForAllocataion($options);
            $msRanks = $this->cList->getAllRanks();
            $msCadres = $this->cList->getRankCadre($this->request->data['ms_rank_id']);

            $this->set(compact('jebLists', 'msCadres', 'msRanks'));
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
