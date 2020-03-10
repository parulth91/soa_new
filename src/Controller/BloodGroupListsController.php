<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * BloodGroupLists Controller
 *
 * @property \App\Model\Table\BloodGroupListsTable $BloodGroupLists
 *
 * @method \App\Model\Entity\BloodGroupList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BloodGroupListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $bloodGroupLists = $this->paginate($this->BloodGroupLists);

        $this->set(compact('bloodGroupLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Blood Group List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bloodGroupList = $this->BloodGroupLists->get($id, [
            'contain' => []
        ]);

        $this->set('bloodGroupList', $bloodGroupList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bloodGroupList = $this->BloodGroupLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $bloodGroupList = $this->BloodGroupLists->patchEntity($bloodGroupList, $this->request->getData());
            if ($this->BloodGroupLists->save($bloodGroupList)) {
                $this->Flash->success(__('The blood group list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blood group list could not be saved. Please, try again.'));
        }
        $this->set(compact('bloodGroupList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blood Group List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bloodGroupList = $this->BloodGroupLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $bloodGroupList = $this->BloodGroupLists->patchEntity($bloodGroupList, $this->request->getData());
            if ($this->BloodGroupLists->save($bloodGroupList)) {
                $this->Flash->success(__('The blood group list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blood group list could not be saved. Please, try again.'));
        }
        $this->set(compact('bloodGroupList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blood Group List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bloodGroupList = $this->BloodGroupLists->get($id);
        if ($this->BloodGroupLists->delete($bloodGroupList)) {
            $this->Flash->success(__('The blood group list has been deleted.'));
        } else {
            $this->Flash->error(__('The blood group list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
