<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class AjaxController extends AppController {

    public function index() {
        
    }

    public function simple() {
        
    }

    public function findStateToCountry() {
         
       // debug($this->request->is(array('ajax'));
        //if ($this->request->is(array('ajax'))) {
         

            $stateArrList = '';
            $districtArrList = '';
            if (filter_var($_REQUEST['ms_country_id'], FILTER_VALIDATE_INT)) {
                $country_id = $_REQUEST['ms_country_id'];
                $msStateData = TableRegistry::get('MsStates');
                $stateDataFetch = $msStateData->find('all')
                        ->where(['MsStates.ms_country_id' => $country_id, 'MsStates.is_active' => TRUE])
                        ->toArray();
                if (!empty($stateDataFetch)) {
                    //debug($stateDataFetch);

                    $stateArrList .= '<option value="">Select State</option>';
                    $districtArrList .= '<option value="">Select District</option>';
                    foreach ($stateDataFetch as $k => $val_stateDataFetch) {

                        if (!empty($_REQUEST['ms_state_id'])) {
                            $ms_state_id = $_REQUEST['ms_state_id'];
                            if ($val_stateDataFetch['id'] == $ms_state_id) {
                                $selectedPermanentState = 'selected';
                                $stateArrList .= '<option  selected="' . $selectedPermanentState . '" value="' . $val_stateDataFetch['id'] . '">' . $val_stateDataFetch['description'] . '</option>';
                            } else {
                                $stateArrList .= '<option  value="' . $val_stateDataFetch['id'] . '">' . $val_stateDataFetch['description'] . '</option>';
                            }
                        }else{
                             $stateArrList .= '<option  value="' . $val_stateDataFetch['id'] . '">' . $val_stateDataFetch['description'] . '</option>';
                        $districtArrList = '<option value="">Select State</option>';
                             
                        }
                        
                    }
                } else {
                    $stateArrList = '<option value="">Select State</option>';
                    $districtArrList = '<option value="">Select State</option>';
                }

                echo $stateArrList . '@' . $districtArrList;
//            } else {
//                 
//            }


exit;

//            $resultJ = json_encode(array('result' => array('now' => $now)));
//            $this->response->type('json');
//            $this->response->body($resultJ);
//
//            return $this->response;
        }
        exit;
    }

    
    public function findDistrictToState() {
                $correspndcDistrictArrList = '';
                    $ms_state_id = $_REQUEST['ms_state_id'];
                    if(empty($ms_state_id)){
                        $correspndcDistrictArrList = 0;exit;
                    }
                    $ms_district_id = $_REQUEST['ms_district_id'];
                    $msDistrictData = TableRegistry::get('MsDistricts');
                    $districtDataFetch = $msDistrictData->find('all')
                            ->where(['MsDistricts.ms_state_id' => $ms_state_id, 'MsDistricts.is_active' => TRUE])
                            ->toArray();
                    if (!empty($districtDataFetch)) {
                        
                        $correspndcDistrictArrList .= '<option value="">Select District</option>';
                        foreach ($districtDataFetch as $val_districtDataFetch) {
                            if($val_districtDataFetch['id']==$ms_district_id){
                            $selectedPermanentState = 'selected';
                                $correspndcDistrictArrList .= '<option selected="' . $selectedPermanentState . '" value="' . $val_districtDataFetch['id'] . '">' . $val_districtDataFetch['description'] . '</option>';
                                
                            }else{
                            $correspndcDistrictArrList .= '<option value="' . $val_districtDataFetch['id'] . '">' . $val_districtDataFetch['description'] . '</option>';
                            }
                            
                            }
                    } else {
                        $correspndcDistrictArrList = 0;
                    }
                    echo $correspndcDistrictArrList;
                    exit;
               
           
        EXIT;
    }

}
