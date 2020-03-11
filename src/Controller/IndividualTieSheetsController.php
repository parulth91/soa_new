<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * IndividualTieSheets Controller
 *
 * @property \App\Model\Table\IndividualTieSheetsTable $IndividualTieSheets
 *
 * @method \App\Model\Entity\IndividualTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IndividualTieSheetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RegisterCandidateEventActivities', 'EventActivityLists']
        ];
        $individualTieSheets = $this->paginate($this->IndividualTieSheets);

        $this->set(compact('individualTieSheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Individual Tie Sheet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $individualTieSheet = $this->IndividualTieSheets->get($id, [
            'contain' => ['RegisterCandidateEventActivities', 'EventActivityLists']
        ]);

        $this->set('individualTieSheet', $individualTieSheet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $individualTieSheet = $this->IndividualTieSheets->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $individualTieSheet = $this->IndividualTieSheets->patchEntity($individualTieSheet, $this->request->getData());
            if ($this->IndividualTieSheets->save($individualTieSheet)) {
                $this->Flash->success(__('The individual tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The individual tie sheet could not be saved. Please, try again.'));
        }
        $registerCandidateEventActivities = $this->IndividualTieSheets->RegisterCandidateEventActivities->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $eventActivityLists = $this->IndividualTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('individualTieSheet', 'registerCandidateEventActivities', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Individual Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $individualTieSheet = $this->IndividualTieSheets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $individualTieSheet = $this->IndividualTieSheets->patchEntity($individualTieSheet, $this->request->getData());
            if ($this->IndividualTieSheets->save($individualTieSheet)) {
                $this->Flash->success(__('The individual tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The individual tie sheet could not be saved. Please, try again.'));
        }
        $registerCandidateEventActivities = $this->IndividualTieSheets->RegisterCandidateEventActivities->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $eventActivityLists = $this->IndividualTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('individualTieSheet', 'registerCandidateEventActivities', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Individual Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $individualTieSheet = $this->IndividualTieSheets->get($id);
        if ($this->IndividualTieSheets->delete($individualTieSheet)) {
            $this->Flash->success(__('The individual tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The individual tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
