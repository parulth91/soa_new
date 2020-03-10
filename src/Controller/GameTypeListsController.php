<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * GameTypeLists Controller
 *
 * @property \App\Model\Table\GameTypeListsTable $GameTypeLists
 *
 * @method \App\Model\Entity\GameTypeList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GameTypeListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $gameTypeLists = $this->paginate($this->GameTypeLists);

        $this->set(compact('gameTypeLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Game Type List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gameTypeList = $this->GameTypeLists->get($id, [
            'contain' => ['ActivityLists']
        ]);

        $this->set('gameTypeList', $gameTypeList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gameTypeList = $this->GameTypeLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $gameTypeList = $this->GameTypeLists->patchEntity($gameTypeList, $this->request->getData());
            if ($this->GameTypeLists->save($gameTypeList)) {
                $this->Flash->success(__('The game type list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game type list could not be saved. Please, try again.'));
        }
        $this->set(compact('gameTypeList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Game Type List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gameTypeList = $this->GameTypeLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $gameTypeList = $this->GameTypeLists->patchEntity($gameTypeList, $this->request->getData());
            if ($this->GameTypeLists->save($gameTypeList)) {
                $this->Flash->success(__('The game type list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game type list could not be saved. Please, try again.'));
        }
        $this->set(compact('gameTypeList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Game Type List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gameTypeList = $this->GameTypeLists->get($id);
        if ($this->GameTypeLists->delete($gameTypeList)) {
            $this->Flash->success(__('The game type list has been deleted.'));
        } else {
            $this->Flash->error(__('The game type list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
