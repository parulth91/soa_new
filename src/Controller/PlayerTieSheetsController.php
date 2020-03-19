<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * PlayerTieSheets Controller
 *
 * @property \App\Model\Table\PlayerTieSheetsTable $PlayerTieSheets
 *
 * @method \App\Model\Entity\PlayerTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayerTieSheetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventActivityLists', 'WinnerPlayers', 'Player1s', 'Player2s']
        ];
        $playerTieSheets = $this->paginate($this->PlayerTieSheets);

        $this->set(compact('playerTieSheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playerTieSheet = $this->PlayerTieSheets->get($id, [
            'contain' => ['EventActivityLists', 'WinnerPlayers', 'Player1s', 'Player2s']
        ]);

        $this->set('playerTieSheet', $playerTieSheet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $playerTieSheet = $this->PlayerTieSheets->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $playerTieSheet = $this->PlayerTieSheets->patchEntity($playerTieSheet, $this->request->getData());
            if ($this->PlayerTieSheets->save($playerTieSheet)) {
                $this->Flash->success(__('The player tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->PlayerTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $winnerPlayers = $this->PlayerTieSheets->WinnerPlayers->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $player1s = $this->PlayerTieSheets->Player1s->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $player2s = $this->PlayerTieSheets->Player2s->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('playerTieSheet', 'eventActivityLists', 'winnerPlayers', 'player1s', 'player2s'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $playerTieSheet = $this->PlayerTieSheets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $playerTieSheet = $this->PlayerTieSheets->patchEntity($playerTieSheet, $this->request->getData());
            if ($this->PlayerTieSheets->save($playerTieSheet)) {
                $this->Flash->success(__('The player tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->PlayerTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $winnerPlayers = $this->PlayerTieSheets->WinnerPlayers->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $player1s = $this->PlayerTieSheets->Player1s->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $player2s = $this->PlayerTieSheets->Player2s->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('playerTieSheet', 'eventActivityLists', 'winnerPlayers', 'player1s', 'player2s'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $playerTieSheet = $this->PlayerTieSheets->get($id);
        if ($this->PlayerTieSheets->delete($playerTieSheet)) {
            $this->Flash->success(__('The player tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The player tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
