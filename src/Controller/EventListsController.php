<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * EventLists Controller
 *
 * @property \App\Model\Table\EventListsTable $EventLists
 *
 * @method \App\Model\Entity\EventList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
        $eventList = $this->EventLists->newEntity();
        if ($this->request->is('post')) {
           
            
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 //debug($this->request->data['event_year']['year']);
                 $this->request->data['event_year']=$this->request->data['event_year']['year'];
                 //die;
               // $this->request->data['event_year'] =date_format('Y',$this->request->data['event_year']);//die;
                 $this->request->data['event_start_date']=date('Y/m/d',strtotime($this->request->data['event_start_date']));
                 $this->request->data['event_end_date']=date('Y/m/d',strtotime($this->request->data['event_end_date']));
                 $this->request->data['registration_start_date']=date('Y/m/d',strtotime($this->request->data['registration_start_date']));
                 $this->request->data['registration_end_date']=date('Y/m/d',strtotime($this->request->data['registration_end_date']));
                // print_r($this->request->data);die;
            $eventList = $this->EventLists->patchEntity($eventList, $this->request->Data());
           // print_r($eventList);die;
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
    public function edit($id = null)
    {
        $eventList = $this->EventLists->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;
                                $this->request->data['event_year']=$this->request->data['event_year']['year'];
                               // $this->request->data['event_year']=date_format('Y',strtotime($this->request->data['event_year']));
                                $this->request->data['event_start_date']=date('Y/m/d',strtotime($this->request->data['event_start_date']));
                                $this->request->data['event_end_date']=date('Y/m/d',strtotime($this->request->data['event_end_date']));
                                $this->request->data['registration_start_date']=date('Y/m/d',strtotime($this->request->data['registration_start_date']));
                                $this->request->data['registration_end_date']=date('Y/m/d',strtotime($this->request->data['registration_end_date']));
                 
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventList = $this->EventLists->get($id);
        if ($this->EventLists->delete($eventList)) {
            $this->Flash->success(__('The event list has been deleted.'));
        } else {
            $this->Flash->error(__('The event list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
