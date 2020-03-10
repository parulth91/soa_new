<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * DistrictLists Controller
 *
 * @property \App\Model\Table\DistrictListsTable $DistrictLists
 *
 * @method \App\Model\Entity\DistrictList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DistrictListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['StateLists']
        ];
        $districtLists = $this->paginate($this->DistrictLists);

        $this->set(compact('districtLists'));
    }

    /**
     * View method
     *
     * @param string|null $id District List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $districtList = $this->DistrictLists->get($id, [
            'contain' => ['StateLists']
        ]);

        $this->set('districtList', $districtList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $districtList = $this->DistrictLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $districtList = $this->DistrictLists->patchEntity($districtList, $this->request->getData());
            if ($this->DistrictLists->save($districtList)) {
                $this->Flash->success(__('The district list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The district list could not be saved. Please, try again.'));
        }
        $stateLists = $this->DistrictLists->StateLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active'=>true])->order('description');
        $this->set(compact('districtList', 'stateLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id District List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $districtList = $this->DistrictLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $districtList = $this->DistrictLists->patchEntity($districtList, $this->request->getData());
            if ($this->DistrictLists->save($districtList)) {
                $this->Flash->success(__('The district list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The district list could not be saved. Please, try again.'));
        }
        $stateLists = $this->DistrictLists->StateLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('districtList', 'stateLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id District List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $districtList = $this->DistrictLists->get($id);
        if ($this->DistrictLists->delete($districtList)) {
            $this->Flash->success(__('The district list has been deleted.'));
        } else {
            $this->Flash->error(__('The district list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
