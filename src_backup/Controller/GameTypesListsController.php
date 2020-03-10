<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * GameTypesLists Controller
 *
 * @property \App\Model\Table\GameTypesListsTable $GameTypesLists
 *
 * @method \App\Model\Entity\GameTypesList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GameTypesListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $gameTypesLists = $this->paginate($this->GameTypesLists);

        $this->set(compact('gameTypesLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Game Types List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gameTypesList = $this->GameTypesLists->get($id, [
            'contain' => []
        ]);

        $this->set('gameTypesList', $gameTypesList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gameTypesList = $this->GameTypesLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $gameTypesList = $this->GameTypesLists->patchEntity($gameTypesList, $this->request->getData());
            if ($this->GameTypesLists->save($gameTypesList)) {
                $this->Flash->success(__('The game types list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game types list could not be saved. Please, try again.'));
        }
        $this->set(compact('gameTypesList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Game Types List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gameTypesList = $this->GameTypesLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $gameTypesList = $this->GameTypesLists->patchEntity($gameTypesList, $this->request->getData());
            if ($this->GameTypesLists->save($gameTypesList)) {
                $this->Flash->success(__('The game types list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game types list could not be saved. Please, try again.'));
        }
        $this->set(compact('gameTypesList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Game Types List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gameTypesList = $this->GameTypesLists->get($id);
        if ($this->GameTypesLists->delete($gameTypesList)) {
            $this->Flash->success(__('The game types list has been deleted.'));
        } else {
            $this->Flash->error(__('The game types list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
