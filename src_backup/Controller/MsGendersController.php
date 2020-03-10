<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * MsGenders Controller
 *
 * @property \App\Model\Table\MsGendersTable $MsGenders
 *
 * @method \App\Model\Entity\MsGender[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MsGendersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $msGenders = $this->paginate($this->MsGenders);

        $this->set(compact('msGenders'));
    }

    /**
     * View method
     *
     * @param string|null $id Ms Gender id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $msGender = $this->MsGenders->get($id, [
            'contain' => ['EmployeeInformations']
        ]);

        $this->set('msGender', $msGender);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $msGender = $this->MsGenders->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $msGender = $this->MsGenders->patchEntity($msGender, $this->request->getData());
            if ($this->MsGenders->save($msGender)) {
                $this->Flash->success(__('The ms gender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ms gender could not be saved. Please, try again.'));
        }
        $this->set(compact('msGender'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ms Gender id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $msGender = $this->MsGenders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $msGender = $this->MsGenders->patchEntity($msGender, $this->request->getData());
            if ($this->MsGenders->save($msGender)) {
                $this->Flash->success(__('The ms gender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ms gender could not be saved. Please, try again.'));
        }
        $this->set(compact('msGender'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ms Gender id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $msGender = $this->MsGenders->get($id);
        if ($this->MsGenders->delete($msGender)) {
            $this->Flash->success(__('The ms gender has been deleted.'));
        } else {
            $this->Flash->error(__('The ms gender could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
