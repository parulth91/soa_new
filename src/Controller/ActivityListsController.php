<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * ActivityLists Controller
 *
 * @property \App\Model\Table\ActivityListsTable $ActivityLists
 *
 * @method \App\Model\Entity\ActivityList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['WeightCategoryLists', 'GenderLists', 'GameTypeLists', 'AgeGroupLists']
        ];
        $activityLists = $this->paginate($this->ActivityLists);

        $this->set(compact('activityLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityList = $this->ActivityLists->get($id, [
            'contain' => ['WeightCategoryLists', 'GenderLists', 'GameTypeLists', 'AgeGroupLists']
        ]);

        $this->set('activityList', $activityList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityList = $this->ActivityLists->newEntity();
       // debug($this->request->is('post'));//die;
        if ($this->request->is('post')) {
            if($this->request->data['game_type_list_id'] == 2){

                $this->request->data['minimum_player_participating'] = 1;
                $this->request->data['maximum_player_participating'] = 1;
            }
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $activityList = $this->ActivityLists->patchEntity($activityList, $this->request->getData());
            if ($this->ActivityLists->save($activityList)) {
                $this->Flash->success(__('The activity list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity list could not be saved. Please, try again.'));
        }
        $weightCategoryLists = $this->ActivityLists->WeightCategoryLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $genderLists = $this->ActivityLists->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $gameTypeLists = $this->ActivityLists->GameTypeLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $ageGroupLists = $this->ActivityLists->AgeGroupLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('activityList', 'weightCategoryLists', 'genderLists', 'gameTypeLists', 'ageGroupLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityList = $this->ActivityLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if($this->request->data['game_type_list_id'] == 2){

                $this->request->data['minimum_player_participating'] = 1;
                $this->request->data['maximum_player_participating'] = 1;
            }
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $activityList = $this->ActivityLists->patchEntity($activityList, $this->request->getData());
            if ($this->ActivityLists->save($activityList)) {
                $this->Flash->success(__('The activity list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity list could not be saved. Please, try again.'));
        }
        $weightCategoryLists = $this->ActivityLists->WeightCategoryLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $genderLists = $this->ActivityLists->GenderLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $gameTypeLists = $this->ActivityLists->GameTypeLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $ageGroupLists = $this->ActivityLists->AgeGroupLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('activityList', 'weightCategoryLists', 'genderLists', 'gameTypeLists', 'ageGroupLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityList = $this->ActivityLists->get($id);
        if ($this->ActivityLists->delete($activityList)) {
            $this->Flash->success(__('The activity list has been deleted.'));
        } else {
            $this->Flash->error(__('The activity list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
