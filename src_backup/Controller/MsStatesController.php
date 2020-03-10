<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * MsStates Controller
 *
 * @property \App\Model\Table\MsStatesTable $MsStates
 *
 * @method \App\Model\Entity\MsState[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MsStatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $msStates = $this->paginate($this->MsStates);

        $this->set(compact('msStates'));
    }

    /**
     * View method
     *
     * @param string|null $id Ms State id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $msState = $this->MsStates->get($id, [
            'contain' => []
        ]);

        $this->set('msState', $msState);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $msState = $this->MsStates->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $msState = $this->MsStates->patchEntity($msState, $this->request->getData());
            if ($this->MsStates->save($msState)) {
                $this->Flash->success(__('The ms state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ms state could not be saved. Please, try again.'));
        }
        $this->set(compact('msState'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ms State id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $msState = $this->MsStates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $msState = $this->MsStates->patchEntity($msState, $this->request->getData());
            if ($this->MsStates->save($msState)) {
                $this->Flash->success(__('The ms state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ms state could not be saved. Please, try again.'));
        }
        $this->set(compact('msState'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ms State id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $msState = $this->MsStates->get($id);
        if ($this->MsStates->delete($msState)) {
            $this->Flash->success(__('The ms state has been deleted.'));
        } else {
            $this->Flash->error(__('The ms state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
