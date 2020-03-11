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
class TeamTieSheetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
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
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teamTieSheet = $this->TeamTieSheets->get($id, [
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
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teamTieSheet = $this->TeamTieSheets->get($id);
        if ($this->TeamTieSheets->delete($teamTieSheet)) {
            $this->Flash->success(__('The team tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The team tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
