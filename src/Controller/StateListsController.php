<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * StateLists Controller
 *
 * @property \App\Model\Table\StateListsTable $StateLists
 *
 * @method \App\Model\Entity\StateList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StateListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CountryLists']
        ];
        $stateLists = $this->paginate($this->StateLists);

        $this->set(compact('stateLists'));
    }

    /**
     * View method
     *
     * @param string|null $id State List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stateList = $this->StateLists->get($id, [
            'contain' => ['CountryLists', 'DistrictLists']
        ]);

        $this->set('stateList', $stateList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stateList = $this->StateLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $stateList = $this->StateLists->patchEntity($stateList, $this->request->getData());
            if ($this->StateLists->save($stateList)) {
                $this->Flash->success(__('The state list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state list could not be saved. Please, try again.'));
        }
        $countryLists = $this->StateLists->CountryLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('stateList', 'countryLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id State List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stateList = $this->StateLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $stateList = $this->StateLists->patchEntity($stateList, $this->request->getData());
            if ($this->StateLists->save($stateList)) {
                $this->Flash->success(__('The state list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state list could not be saved. Please, try again.'));
        }
        $countryLists = $this->StateLists->CountryLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('stateList', 'countryLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id State List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stateList = $this->StateLists->get($id);
        if ($this->StateLists->delete($stateList)) {
            $this->Flash->success(__('The state list has been deleted.'));
        } else {
            $this->Flash->error(__('The state list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
