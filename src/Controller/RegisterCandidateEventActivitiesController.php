<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * RegisterCandidateEventActivities Controller
 *
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable $RegisterCandidateEventActivities
 *
 * @method \App\Model\Entity\RegisterCandidateEventActivity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegisterCandidateEventActivitiesController extends AppController
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
        $registerCandidateEventActivities = $this->paginate($this->RegisterCandidateEventActivities);

        $this->set(compact('registerCandidateEventActivities'));
    }

    /**
     * View method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id, [
            'contain' => ['EventActivityLists']
        ]);

        $this->set('registerCandidateEventActivity', $registerCandidateEventActivity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidateEventActivities->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidateEventActivities->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('registerCandidateEventActivity', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->patchEntity($registerCandidateEventActivity, $this->request->getData());
            if ($this->RegisterCandidateEventActivities->save($registerCandidateEventActivity)) {
                $this->Flash->success(__('The register candidate event activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register candidate event activity could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->RegisterCandidateEventActivities->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        $this->set(compact('registerCandidateEventActivity', 'eventActivityLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Register Candidate Event Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registerCandidateEventActivity = $this->RegisterCandidateEventActivities->get($id);
        if ($this->RegisterCandidateEventActivities->delete($registerCandidateEventActivity)) {
            $this->Flash->success(__('The register candidate event activity has been deleted.'));
        } else {
            $this->Flash->error(__('The register candidate event activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
