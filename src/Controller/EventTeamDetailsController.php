<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * EventTeamDetails Controller
 *
 * @property \App\Model\Table\EventTeamDetailsTable $EventTeamDetails
 *
 * @method \App\Model\Entity\EventTeamDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventTeamDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventActivityLists', 'StateLists']
        ];
        $eventTeamDetails = $this->paginate($this->EventTeamDetails);

        $this->set(compact('eventTeamDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Event Team Detail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventTeamDetail = $this->EventTeamDetails->get($id, [
            'contain' => ['EventActivityLists', 'StateLists', 'RegisterCandidateEventActivities', 'TeamTieSheets']
        ]);

        $this->set('eventTeamDetail', $eventTeamDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventTeamDetail = $this->EventTeamDetails->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $eventTeamDetail = $this->EventTeamDetails->patchEntity($eventTeamDetail, $this->request->getData());
            if ($this->EventTeamDetails->save($eventTeamDetail)) {
                $this->Flash->success(__('The event team detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event team detail could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->EventTeamDetails->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $stateLists = $this->EventTeamDetails->StateLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('eventTeamDetail', 'eventActivityLists', 'stateLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Team Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventTeamDetail = $this->EventTeamDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $eventTeamDetail = $this->EventTeamDetails->patchEntity($eventTeamDetail, $this->request->getData());
            if ($this->EventTeamDetails->save($eventTeamDetail)) {
                $this->Flash->success(__('The event team detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event team detail could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->EventTeamDetails->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $stateLists = $this->EventTeamDetails->StateLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('eventTeamDetail', 'eventActivityLists', 'stateLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Team Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventTeamDetail = $this->EventTeamDetails->get($id);
        if ($this->EventTeamDetails->delete($eventTeamDetail)) {
            $this->Flash->success(__('The event team detail has been deleted.'));
        } else {
            $this->Flash->error(__('The event team detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
