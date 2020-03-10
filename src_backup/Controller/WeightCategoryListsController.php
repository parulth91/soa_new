<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * WeightCategoryLists Controller
 *
 * @property \App\Model\Table\WeightCategoryListsTable $WeightCategoryLists
 *
 * @method \App\Model\Entity\WeightCategoryList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WeightCategoryListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $weightCategoryLists = $this->paginate($this->WeightCategoryLists);

        $this->set(compact('weightCategoryLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Weight Category List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weightCategoryList = $this->WeightCategoryLists->get($id, [
            'contain' => ['ActivityLists']
        ]);

        $this->set('weightCategoryList', $weightCategoryList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weightCategoryList = $this->WeightCategoryLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $weightCategoryList = $this->WeightCategoryLists->patchEntity($weightCategoryList, $this->request->getData());
            if ($this->WeightCategoryLists->save($weightCategoryList)) {
                $this->Flash->success(__('The weight category list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weight category list could not be saved. Please, try again.'));
        }
        $this->set(compact('weightCategoryList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Weight Category List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weightCategoryList = $this->WeightCategoryLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $weightCategoryList = $this->WeightCategoryLists->patchEntity($weightCategoryList, $this->request->getData());
            if ($this->WeightCategoryLists->save($weightCategoryList)) {
                $this->Flash->success(__('The weight category list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weight category list could not be saved. Please, try again.'));
        }
        $this->set(compact('weightCategoryList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Weight Category List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weightCategoryList = $this->WeightCategoryLists->get($id);
        if ($this->WeightCategoryLists->delete($weightCategoryList)) {
            $this->Flash->success(__('The weight category list has been deleted.'));
        } else {
            $this->Flash->error(__('The weight category list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
