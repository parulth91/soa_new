<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * ReportingLists Controller
 *
 * @property \App\Model\Table\ReportingListsTable $ReportingLists
 *
 * @method \App\Model\Entity\ReportingList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportingListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $reportingLists = $this->paginate($this->ReportingLists);

        $this->set(compact('reportingLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Reporting List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportingList = $this->ReportingLists->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('reportingList', $reportingList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportingList = $this->ReportingLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $reportingList = $this->ReportingLists->patchEntity($reportingList, $this->request->getData());
            if ($this->ReportingLists->save($reportingList)) {
                $this->Flash->success(__('The reporting list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reporting list could not be saved. Please, try again.'));
        }
        $users = $this->ReportingLists->Users->find('list', ['keyField' => 'id', 'valueField' => 'username'])->where(['active'=>true])->order('username');
        $this->set(compact('reportingList', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reporting List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportingList = $this->ReportingLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $reportingList = $this->ReportingLists->patchEntity($reportingList, $this->request->getData());
            if ($this->ReportingLists->save($reportingList)) {
                $this->Flash->success(__('The reporting list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reporting list could not be saved. Please, try again.'));
        }
        $users = $this->ReportingLists->Users->find('list', ['keyField' => 'id', 'valueField' => 'username'])->where(['active'=>true])->order('username');
        $this->set(compact('reportingList', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reporting List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportingList = $this->ReportingLists->get($id);
        if ($this->ReportingLists->delete($reportingList)) {
            $this->Flash->success(__('The reporting list has been deleted.'));
        } else {
            $this->Flash->error(__('The reporting list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
