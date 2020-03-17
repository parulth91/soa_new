<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * EventActivityLists Controller
 *
 * @property \App\Model\Table\EventActivityListsTable $EventActivityLists
 *
 * @method \App\Model\Entity\EventActivityList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventActivityListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventLists', 'ActivityLists']
        ];
        $eventActivityLists = $this->paginate($this->EventActivityLists);

        $this->set(compact('eventActivityLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Event Activity List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventActivityList = $this->EventActivityLists->get($id, [
            'contain' => ['EventLists', 'ActivityLists', 'EventTeamDetails', 'RegisterCandidateEventActivities', 'RegisterCandidates', 'TeamTieSheets']
        ]);

        $this->set('eventActivityList', $eventActivityList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventActivityList = $this->EventActivityLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $eventActivityList = $this->EventActivityLists->patchEntity($eventActivityList, $this->request->getData());
            if ($this->EventActivityLists->save($eventActivityList)) {
                $this->Flash->success(__('The event activity list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event activity list could not be saved. Please, try again.'));
        }
        $eventLists = $this->EventActivityLists->EventLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $activityLists = $this->EventActivityLists->ActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('eventActivityList', 'eventLists', 'activityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Activity List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventActivityList = $this->EventActivityLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $eventActivityList = $this->EventActivityLists->patchEntity($eventActivityList, $this->request->getData());
            if ($this->EventActivityLists->save($eventActivityList)) {
                $this->Flash->success(__('The event activity list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event activity list could not be saved. Please, try again.'));
        }
        $eventLists = $this->EventActivityLists->EventLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $activityLists = $this->EventActivityLists->ActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('eventActivityList', 'eventLists', 'activityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Activity List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventActivityList = $this->EventActivityLists->get($id);
        if ($this->EventActivityLists->delete($eventActivityList)) {
            $this->Flash->success(__('The event activity list has been deleted.'));
        } else {
            $this->Flash->error(__('The event activity list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
