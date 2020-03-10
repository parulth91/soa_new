<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * GenderLists Controller
 *
 * @property \App\Model\Table\GenderListsTable $GenderLists
 *
 * @method \App\Model\Entity\GenderList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GenderListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $genderLists = $this->paginate($this->GenderLists);

        $this->set(compact('genderLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Gender List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $genderList = $this->GenderLists->get($id, [
            'contain' => ['ActivityLists']
        ]);

        $this->set('genderList', $genderList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $genderList = $this->GenderLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $genderList = $this->GenderLists->patchEntity($genderList, $this->request->getData());
            if ($this->GenderLists->save($genderList)) {
                $this->Flash->success(__('The gender list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gender list could not be saved. Please, try again.'));
        }
        $this->set(compact('genderList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gender List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $genderList = $this->GenderLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $genderList = $this->GenderLists->patchEntity($genderList, $this->request->getData());
            if ($this->GenderLists->save($genderList)) {
                $this->Flash->success(__('The gender list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gender list could not be saved. Please, try again.'));
        }
        $this->set(compact('genderList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gender List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $genderList = $this->GenderLists->get($id);
        if ($this->GenderLists->delete($genderList)) {
            $this->Flash->success(__('The gender list has been deleted.'));
        } else {
            $this->Flash->error(__('The gender list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
