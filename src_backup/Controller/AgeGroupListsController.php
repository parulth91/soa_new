<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * AgeGroupLists Controller
 *
 * @property \App\Model\Table\AgeGroupListsTable $AgeGroupLists
 *
 * @method \App\Model\Entity\AgeGroupList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AgeGroupListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $ageGroupLists = $this->paginate($this->AgeGroupLists);

        $this->set(compact('ageGroupLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Age Group List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ageGroupList = $this->AgeGroupLists->get($id, [
            'contain' => ['ActivityLists']
        ]);

        $this->set('ageGroupList', $ageGroupList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ageGroupList = $this->AgeGroupLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $ageGroupList = $this->AgeGroupLists->patchEntity($ageGroupList, $this->request->getData());
            if ($this->AgeGroupLists->save($ageGroupList)) {
                $this->Flash->success(__('The age group list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The age group list could not be saved. Please, try again.'));
        }
        $this->set(compact('ageGroupList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Age Group List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ageGroupList = $this->AgeGroupLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $ageGroupList = $this->AgeGroupLists->patchEntity($ageGroupList, $this->request->getData());
            if ($this->AgeGroupLists->save($ageGroupList)) {
                $this->Flash->success(__('The age group list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The age group list could not be saved. Please, try again.'));
        }
        $this->set(compact('ageGroupList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Age Group List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ageGroupList = $this->AgeGroupLists->get($id);
        if ($this->AgeGroupLists->delete($ageGroupList)) {
            $this->Flash->success(__('The age group list has been deleted.'));
        } else {
            $this->Flash->error(__('The age group list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
