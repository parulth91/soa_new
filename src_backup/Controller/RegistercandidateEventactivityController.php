<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * RegistercandidateEventactivity Controller
 *
 * @property \App\Model\Table\RegistercandidateEventactivityTable $RegistercandidateEventactivity
 *
 * @method \App\Model\Entity\RegistercandidateEventactivity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistercandidateEventactivityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventActivityLists']
        ];
        $registercandidateEventactivity = $this->paginate($this->RegistercandidateEventactivity);

        $this->set(compact('registercandidateEventactivity'));
    }

    /**
     * View method
     *
     * @param string|null $id Registercandidate Eventactivity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registercandidateEventactivity = $this->RegistercandidateEventactivity->get($id, [
            'contain' => ['EventActivityLists']
        ]);

        $this->set('registercandidateEventactivity', $registercandidateEventactivity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registercandidateEventactivity = $this->RegistercandidateEventactivity->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $registercandidateEventactivity = $this->RegistercandidateEventactivity->patchEntity($registercandidateEventactivity, $this->request->getData());
            if ($this->RegistercandidateEventactivity->save($registercandidateEventactivity)) {
                $this->Flash->success(__('The registercandidate eventactivity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registercandidate eventactivity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegistercandidateEventactivity->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('registercandidateEventactivity', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registercandidate Eventactivity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registercandidateEventactivity = $this->RegistercandidateEventactivity->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $registercandidateEventactivity = $this->RegistercandidateEventactivity->patchEntity($registercandidateEventactivity, $this->request->getData());
            if ($this->RegistercandidateEventactivity->save($registercandidateEventactivity)) {
                $this->Flash->success(__('The registercandidate eventactivity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registercandidate eventactivity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegistercandidateEventactivity->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('registercandidateEventactivity', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registercandidate Eventactivity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registercandidateEventactivity = $this->RegistercandidateEventactivity->get($id);
        if ($this->RegistercandidateEventactivity->delete($registercandidateEventactivity)) {
            $this->Flash->success(__('The registercandidate eventactivity has been deleted.'));
        } else {
            $this->Flash->error(__('The registercandidate eventactivity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
