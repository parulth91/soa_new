<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * CountryLists Controller
 *
 * @property \App\Model\Table\CountryListsTable $CountryLists
 *
 * @method \App\Model\Entity\CountryList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CountryListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $countryLists = $this->paginate($this->CountryLists);

        $this->set(compact('countryLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Country List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $countryList = $this->CountryLists->get($id, [
            'contain' => ['StateLists']
        ]);

        $this->set('countryList', $countryList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $countryList = $this->CountryLists->newEntity();
        if ($this->request->is('post')) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                 
            $countryList = $this->CountryLists->patchEntity($countryList, $this->request->getData());
            if ($this->CountryLists->save($countryList)) {
                $this->Flash->success(__('The country list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The country list could not be saved. Please, try again.'));
        }
        $this->set(compact('countryList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Country List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $countryList = $this->CountryLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                 $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
                 $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
                                $currentTimeStamp = Time::now();
                                $currentTimeStamp->i18nFormat();
                                $this->request->data['modified'] = $currentTimeStamp;

                 
            $countryList = $this->CountryLists->patchEntity($countryList, $this->request->getData());
            if ($this->CountryLists->save($countryList)) {
                $this->Flash->success(__('The country list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The country list could not be saved. Please, try again.'));
        }
        $this->set(compact('countryList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Country List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $countryList = $this->CountryLists->get($id);
        if ($this->CountryLists->delete($countryList)) {
            $this->Flash->success(__('The country list has been deleted.'));
        } else {
            $this->Flash->error(__('The country list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
