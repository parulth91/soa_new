<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * EmployeeInformations Controller
 *
 * @property \App\Model\Table\EmployeeInformationsTable $EmployeeInformations
 *
 * @method \App\Model\Entity\EmployeeInformation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JebAllocationsController extends AppController {

    public function ajaxShowList() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }
        $jebLists = $this->getJebDataForAllocataion($options);

        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {

            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }
//debug($jebLists->toArray());die;
        $total = $jebLists->count();
        if (empty($jebLists->toArray())) {
            $percentage = 0;
        } else {
            if ($count_choice_requested != null) {
                $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
            } else {
                $percentage = 0;
            }
        }
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function home_state_check($rank_id, $cadre_id) {
        $connection = ConnectionManager::get('default');
        $EmployeeInformationsTable = TableRegistry::get('EmployeeInformations');
        $jebLists = $EmployeeInformationsTable
                ->find('all')
                //->select(['id','regimental_number','ms_current_unit_id','home_ms_state_id','homemsstates.description'])
                ->contain(['mscurrentunits.msstates', 'previouspostings.mslocations.msstates', 'homemsstates'])
                ->where(['ms_rank_id' => $rank_id, 'ms_cadre_id' => $cadre_id])
                ->order(['EmployeeInformations.point_assigned' => 'desc']);
        //debug($jebList);die;
        $MsStatesTable = TableRegistry::get('MsStates');


        foreach ($jebLists as $jebList) {
            //debug($jebList->home_ms_state_id);
            $stateLists = $MsStatesTable
                    ->find('all')
                    ->select(['id'])
                    ->where(['description like' => '%NE Region%', 'id' => $jebList->home_ms_state_id]);
            if (!empty($stateLists->toArray()) || $jebList->home_ms_state_id == '10') {
                if ($jebList->tenure_more_than_10_in_ne == true || $jebList->tenure_more_than_10_in_leh == true) {
                    $update_status = "update employee_informations set home_state_posting_allowed=false where regimental_number='" . $jebList->regimental_number . "'";
                } else {
                    if($jebList->no_of_months_served_in_home_state > '180'){
                        $update_status = "update employee_informations set home_state_posting_allowed=false where regimental_number='" . $jebList->regimental_number . "'";
                    }else{
                    $update_status = "update employee_informations set home_state_posting_allowed=true where regimental_number='" . $jebList->regimental_number . "'";
                    }
                }
            } else {
                $update_status = "update employee_informations set home_state_posting_allowed=false where regimental_number='" . $jebList->regimental_number . "'";
            }
            $connection->execute($update_status);
        }
    }

    public function ajaxAssignPoints() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];

        $this->home_state_check($rank_id, $cadre_id);


        $type_id = $_REQUEST['type_id'];
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }

        $jebLists = $this->getJebDataForAllocataion($options);
        $connection = ConnectionManager::get('default');
        $tableGeneration = "update employee_informations set point_assigned=null where ms_rank_id='" . $rank_id . "' and ms_cadre_id='" . $cadre_id . "'";
        // debug($tableGeneration);
        $connection->execute($tableGeneration);

        $this->updateAllMonthsCalculation($rank_id, $cadre_id);
        $tableGeneration = "select * from assign_points(" . $rank_id . "," . $cadre_id . "," . $type_id . ")";
        // debug($tableGeneration);
        $connection->execute($tableGeneration);
        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {

            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();

        if($count_choice_requested != null){
            $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        } else{
            $percentage = 0;
        }
                
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function updateAllMonthsCalculation($rank_id, $cadre_id) {
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        $jebLists = $this->getJebDataForAllocataion($options);
        foreach ($jebLists as $key => $value) {
            $this->updatePeriodForPoints($value);
        }
    }

    public function updatePeriodForPoints($value) {
        $update_period_of_total_service_rendered_in_ha = 0;
        $update_period_of_total_service_rendered_in_eha = 0;
        $update_no_of_months_completed_continuously = 0;
        $no_of_months_in_current_unit = 0;

        $MsUnitsTable = TableRegistry::get('MsUnits');
        $MsUnitsTableData = $MsUnitsTable->find('all')
                        ->select(['cuttoff_date'])->where(['id' => $value['ms_current_unit_id']])->toArray();
        $cuttoff_date = date("Y-m-d", strtotime($MsUnitsTableData[0]->cuttoff_date));
        $home_state_id = $value['home_ms_state_id'];
        $current_ms_unit_category = $value['current_ms_unit_category']['description'];

        if ($value['ms_current_unit']['ms_state_id'] == $home_state_id) {
            $no_of_months_in_current_unit = 0;
        } else {
            $no_of_months_in_current_unit = $this->cList->monthBtwTwoDates($value['date_of_reporting_in_current_unit'], $cuttoff_date);
            if ($current_ms_unit_category == 'HA') {
                $update_period_of_total_service_rendered_in_ha = $no_of_months_in_current_unit;
                $update_no_of_months_completed_continuously = $this->getContinuouslyServedMonths($value['regimental_number'], $value['previous_postings'], $no_of_months_in_current_unit, $value['current_ms_unit_category']['id'], $home_state_id);
            } elseif ($current_ms_unit_category == 'EHA') {
                $update_period_of_total_service_rendered_in_eha = $no_of_months_in_current_unit;
                $update_no_of_months_completed_continuously = $this->getContinuouslyServedMonths($value['regimental_number'], $value['previous_postings'], $no_of_months_in_current_unit, $value['current_ms_unit_category']['id'], $home_state_id);
            
                
            }
        }


        foreach ($value['previous_postings'] as $previous_posting) {
            if ($previous_posting['ms_unit_category']['description'] == 'HA' && $previous_posting['ms_location']['ms_state_id'] != $home_state_id) {
                $update_period_of_total_service_rendered_in_ha = $update_period_of_total_service_rendered_in_ha + $this->cList->monthBtwTwoDates($previous_posting['from_date'], $previous_posting['to_date']);
            } elseif ($previous_posting['ms_unit_category']['description'] == 'EHA' && $previous_posting['ms_location']['ms_state_id'] != $home_state_id) {
                $update_period_of_total_service_rendered_in_eha = $update_period_of_total_service_rendered_in_eha + $this->cList->monthBtwTwoDates($previous_posting['from_date'], $previous_posting['to_date']);
            }
        }
        //debug($value['current_ms_unit_category']['description']);
//        debug($update_period_of_total_service_rendered_in_ha);
//        debug($update_period_of_total_service_rendered_in_eha);
//        debug($update_no_of_months_completed_continuously);
        //debug($value['previous_postings']);
        //die;




        $connection = ConnectionManager::get('default');
        $queryString = "update employee_informations set update_period_rendered_in_ha='" . $update_period_of_total_service_rendered_in_ha . "',
                        update_period_rendered_in_eha='" . $update_period_of_total_service_rendered_in_eha . "',
                            update_months_completed_continuously='" . $update_no_of_months_completed_continuously . "',
                                updated_months_in_current_unit='" . $no_of_months_in_current_unit . "'
                            where regimental_number='" . $value['regimental_number'] . "'";

        $connection->execute($queryString);
    }

    public function getContinuouslyServedMonths($reg, $dataSums, $no_of_months_in_current_unit, $current_ms_unit_category_id, $home_state_id) {


        $no_of_months = 0;
        $i = 0;
        $continuous_sum = $no_of_months_in_current_unit;
        $previous_unit_category_id = $current_ms_unit_category_id;
        foreach ($dataSums as $dataSum) {
            if ($dataSum['ms_location']['ms_state_id'] == $home_state_id) {
                break;
               // continue;
            }

            
            if ($dataSum['ms_unit_category_id'] == '2' || $dataSum['ms_unit_category_id'] == '3') {

                $no_of_months = $this->cList->monthBtwTwoDates($dataSum['from_date'], $dataSum['to_date']);

                if ($previous_unit_category_id == '2' || $previous_unit_category_id == '3') {
                    $continuous_sum = $continuous_sum + $no_of_months;
                    $previous_unit_category_id = $dataSum['ms_unit_category_id'];
                } else {
                    // echo "</br>";                 ;
                    $previous_unit_category_id = '0';
                }
                $i++;
            } else {
                break;
                //continue;
            }
        }
  
        return $continuous_sum;
    }

    public function ajaxAllocateUnit() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];

        // $this->cList->checkAllocation('930090168',$rank_id,$cadre_id);
        //die;
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }
        $connection = ConnectionManager::get('default');
        $tableGeneration = "select * from allocate_unit(" . $rank_id . "," . $cadre_id . "," . $type_id . ")";
        //debug($tableGeneration);
        $connection->execute($tableGeneration);

        $jebRegNumLists = $this->getJebDataOfReg($options);
        foreach ($jebRegNumLists as $key => $value) {
            $this->cList->checkAllocation($value['regimental_number'], $rank_id, $cadre_id);
        }

        $jebLists = $this->getJebDataForAllocataion($options);
        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {
            // $this->cList->checkAllocation($value['regimental_number'],$rank_id,$cadre_id);
            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();
//        $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        if($count_choice_requested != null){
            $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        } else{
            $percentage = 0;
        }
        
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function updateUnAllocated() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];

        // $this->cList->checkAllocation('930090168',$rank_id,$cadre_id);
        //die;
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }





        $connection = ConnectionManager::get('default');
        $tableGeneration = "select * from allocate_unit(" . $rank_id . "," . $cadre_id . "," . $type_id . ")";
        //debug($tableGeneration);
        $connection->execute($tableGeneration);

        $jebRegNumLists = $this->getJebDataOfReg($options);
        foreach ($jebRegNumLists as $key => $value) {
            $this->cList->checkAllocation($value['regimental_number'], $rank_id, $cadre_id);
        }

        $jebLists = $this->getJebDataForAllocataion($options);
        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {
            // $this->cList->checkAllocation($value['regimental_number'],$rank_id,$cadre_id);
            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();
        $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function ajaxUpdateTransferOut() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }

        $jebLists = $this->getJebDataForAllocataion($options);
        $this->cList->updateTransferOutVacancyAll($rank_id, $cadre_id);
        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {

            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();
        // $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        if($count_choice_requested != null){
            $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        } else{
            $percentage = 0;
        }
        
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function ajaxUpdateMonths() {

        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }

        $jebLists = $this->getJebDataForAllocataion($options);

        $this->cList->updateMonths($rank_id, $cadre_id);
        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {

            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();
        $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function index() {
        if ($this->request->is('post')) {
            $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
            $options = ['EmployeeInformations.ms_rank_id' => $this->request->data['ms_rank_id'],
                'EmployeeInformations.ms_cadre_id' => $this->request->data['ms_cadre_id'],
                'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
            if ($this->request->data['list_type_id'] == '0') {
                //$options['whether_couple_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '1') {
                $options['whether_terminal_case'] = FALSE;
                $options['whether_unfit_for_haa_cold_climate'] = FALSE;
                $options['whether_couple_case'] = FALSE;
                $options['whether_medical_ground_case'] = FALSE;
                $options['whether_compassionate_case'] = FALSE;
            }
            if ($this->request->data['list_type_id'] == '2') {
                $options['whether_terminal_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '3') {
                $options['whether_unfit_for_haa_cold_climate'] = true;
            }
            if ($this->request->data['list_type_id'] == '4') {
                $options['whether_couple_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '5') {
                $options['whether_medical_ground_case'] = true;
            }
            if ($this->request->data['list_type_id'] == '6') {
                $options['whether_compassionate_case'] = true;
            }


            if ($this->request->data['btn'] == 'SHOW LIST') {
                //debug($options);
                $jebLists = $this->getJebDataForAllocataion($options);
            }
            if ($this->request->data['btn'] == 'Update Transfer Out') {
                $jebLists = $this->getJebDataForAllocataion($options);
                $this->cList->updateTransferOutVacancyAll($this->request->data['ms_rank_id'], $this->request->data['ms_cadre_id']);
            }
            if ($this->request->data['btn'] == 'Assign Points') {

                //database for point assignment
                $connection = ConnectionManager::get('default');
                $tableGeneration = "select * from assign_points(" . $this->request->data['ms_rank_id'] . "," . $this->request->data['ms_cadre_id'] . "," . $this->request->data['list_type_id'] . ")";
                // debug($tableGeneration);
                $connection->execute($tableGeneration);
                //return $connection;
//                $jebLists = $this->getJebDataForAllocataion($options);
//                foreach ($jebLists as $jebList) {
//                    $this->cList->assignPointsToEmployee($jebList->regimental_number);
//                }
                //$jebLists = $this->getJebDataForAllocataion($options);
            }




            if ($this->request->data['btn'] == 'Allocate Unit') {
                //debug($this->request->data['list_type_id']);
                $connection = ConnectionManager::get('default');
                $tableGeneration = "select * from allocate_unit(" . $this->request->data['ms_rank_id'] . "," . $this->request->data['ms_cadre_id'] . "," . $this->request->data['list_type_id'] . ")";
                //debug($tableGeneration);
                $connection->execute($tableGeneration);
//                $optionsAllocation = $options;
//                $optionsAllocation['allocated_ms_unit_id IS'] = null;
//                $jebLists = $this->getJebDataForAllocataion($optionsAllocation);
////                debug($jebLists->toArray()); die;
//                foreach ($jebLists as $jebList) {
//                    $data = [
//                        'regimental_number' => $jebList->regimental_number,
//                        'ms_rank_id' => $jebList->ms_rank_id,
//                        'ms_cadre_id' => $jebList->ms_cadre_id,
//                        'ms_current_unit_id' => $jebList->ms_current_unit_id,
//                        'current_ms_unit_category_id' => $jebList->current_ms_unit_category_id,
//                        'choice1_ms_unit_id' => $jebList->choice1_ms_unit_id,
//                        'choice2_ms_unit_id' => $jebList->choice2_ms_unit_id,
//                        'choice3_ms_unit_id' => $jebList->choice3_ms_unit_id,
//                        'choice4_ms_unit_id' => $jebList->choice4_ms_unit_id,
//                        'choice5_ms_unit_id' => $jebList->choice5_ms_unit_id,
//                    ];
//
                // $this->cList->allocateUnit($data);
                //}
            }

            $jebLists = $this->getJebDataForAllocataion($options);
            $msRanks = $this->cList->getAllRanks();
            $msCadres = $this->cList->getRankCadre($this->request->data['ms_rank_id']);

            $this->set(compact('jebLists', 'msCadres', 'msRanks'));
        } else {

            $msRanks = $this->cList->getAllRanks();
            $msCadres = null;
            $this->set(compact('msRanks', 'msCadres'));
        }
    }

    public function ajaxGetRankCadre() {
        $ms_rank_id = $_GET['ms_rank_id'];
        return $this->cList->ajaxGetRankCadre($ms_rank_id);
    }

    public function ajaxGetFrontierUnits() {
        $ms_frontier_id = $_GET['ms_frontier_id'];
        return $this->cList->ajaxGetFrontierUnits($ms_frontier_id);
    }

    public function showJebData() {
        $this->Flash->error(__('The employee information could not be Found'));
    }

    public function getJebDataOfReg($options) {
        $EmployeeInformationsTable = TableRegistry::get('EmployeeInformations');
        $jebLists = $EmployeeInformationsTable
                        ->find('all')
                        ->select(['regimental_number'])
                        ->where([$options])->order(['EmployeeInformations.point_assigned' => 'desc']);
        return $jebLists;
    }

    public function getJebDataForAllocataion($options) {
        $EmployeeInformationsTable = TableRegistry::get('EmployeeInformations');
        $jebLists = $EmployeeInformationsTable
                        ->find('all')
                        ->contain([
                            'AllocatedMsUnits.MsUnitCategories',
                            'Choice1MsUnits',
                            'Choice1MsUnits.MsUnitCategories',
                            'Choice2MsUnits',
                            'Choice2MsUnits.MsUnitCategories',
                            'Choice3MsUnits',
                            'Choice3MsUnits.MsUnitCategories',
                            'Choice4MsUnits',
                            'Choice4MsUnits.MsUnitCategories',
                            'Choice5MsUnits',
                            'Choice5MsUnits.MsUnitCategories',
                            'PatientDetails',
                            'MsNameOfBranches',
                            'MsGenders',
                            'MsRanks',
                            'MsCadres',
                            'MsCurrentUnits',
                            'MsCurrentUnits.MsFrontiers',
                            'MsCurrentUnits.MsRegions',
                            'MsFrontiers',
                            'MsModeOfAppointments',
                            'SportsAttachedMsUnits',
                            'MsRecommendedBy',
                            'MsRecommendedFor',
                            'ContinuousMsUnitCategories',
                            'CurrentMsUnitCategories',
                            'HomeMsStates',
                            'MsMedicalCategories',
                            'MsTypeOfGrievances',
                            'SpouseMsRanks',
                            'SpouseMsCadres',
                            'PatientDetails.MsPatientRelationships',
                            'PatientDetails.MsDiseases',
                            'PatientDetails.MsDiseaseTypes',
                            'MsDiseaseTypes',
                            'PatientDetails.TreatmentCategories',
                            'TreatmentCategories',
                            'PreviousPostings.MsLocations',
                            'PreviousPostings.MsUnits',
                            'PreviousPostings.MsUnits.MsRegions',
                            'QualifiedCourses.MsCourses',
                            'SpouseCurrentMsUnits',
                            'AllocatedMsUnits',
                            'AllocatedMsUnits.MsFrontiers',
                            'AllocatedMsUnits.MsRegions',
                            //'AllocatedMsUnits.MsUnits.MsFrontiers as allocated_unit_frontier',
                            'Choice1MsUnits',
                            'Choice2MsUnits',
                            'Choice3MsUnits',
                            'Choice4MsUnits',
                            'Choice5MsUnits',
                            'MsCentralTeams',
                            'PreviousPostings',
                            'PreviousPostings.MsUnitCategories',
                            'SportsAttachedMsUnits',
                            'QualifiedCourses',
                            'RecommendedTreatmentCategories',
                            'PreviousPostings' => function ($q) {
                                return $q->order(['posting_number' => 'ASC']);
                            }
                        ])
                        ->where([$options])->order(['EmployeeInformations.point_assigned' => 'desc']);
//                       debug($jebLists); die;
        return $jebLists;
    }

    public function manualAllocation() {
        if ($this->request->is('post')) {

            $reg_no = ['regimental_number' => $this->request->data['regimental_number']];

            if ($this->request->data['btn'] == 'SHOW LIST') {
                //debug($reg_no);die;
                $employeeInformations = $this->getJebDataForAllocataion($reg_no);
                if (!empty($employeeInformations->toArray()[0]['date_of_birth'])) {
                    $this->set(compact('employeeInformations'));
                } else {
                    $this->Flash->error(__('The Regimental Number not found.'));
                }
            }

            if ($this->request->data['btn'] == 'Update Manually') {
                //debug($this->request->data);die;
                $connection = ConnectionManager::get('default');

                $allocated_ms_unit_id = $this->request->data['allocated_ms_unit_id'];
                $remarks = $this->request->data['remarks_for_manual_allocation'];
                $regimental_number = $this->request->data['regimental_number'];
                $ms_rank_id = $this->request->data['ms_rank_id'];
                $ms_cadre_id = $this->request->data['ms_cadre_id'];
                $ms_current_unit_id = $this->request->data['ms_current_unit_id'];
                $updateVacancies = "Select allocated_ms_unit_id from employee_informations                                            
                                    where regimental_number = '" . $regimental_number . "'";
                $checkAllocationData = $connection->execute($updateVacancies)->fetchAll('assoc');
                //debug($checkAllocationData[0]['allocated_ms_unit_id']);
                // die;
                if (!empty($checkAllocationData[0]['allocated_ms_unit_id'])) {
                    //Update previous vacancies of unit
                    $updatePreviousVacancies = "UPDATE vacancies
                                            SET 
                                            manual_allocation_count =
                                            CASE 
                                                    WHEN 
                                                        manual_allocation_count = 0 
                                                    THEN 
                                                        0                                                    
                                                    ELSE  
                                                        manual_allocation_count-1
                                             END,
                                                live_vacancy = live_vacancy+1,
                                                transfer_in=transfer_in-1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $checkAllocationData[0]['allocated_ms_unit_id'] . "'";
                    $connection->execute($updatePreviousVacancies);

                    //update current unit vacancies
                    $updateVacancies = "UPDATE vacancies
                                            SET manual_allocation_count = manual_allocation_count+1,
                                                live_vacancy = live_vacancy-1,
                                                transfer_in=transfer_in+1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $allocated_ms_unit_id . "'";
                    $connection->execute($updateVacancies);
                } else {
                    //update current unit vacancies only
                    $updateVacancies = "UPDATE vacancies
                                            SET manual_allocation_count = manual_allocation_count+1,
                                                live_vacancy = live_vacancy -1,
                                                transfer_in=transfer_in+1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $allocated_ms_unit_id . "'";
                    $connection->execute($updateVacancies);
                    $employeeInformations = $this->getJebDataForAllocataion($reg_no);
                    $checkAllocationData[0]['allocated_ms_unit_id'] = 0;
                }

                //Update employee data
                $updateEmployeeManualAllocation = "UPDATE employee_informations
                                            SET 
                                                manual_allocation=true,                                            
                                                allocated_ms_unit_id ='" . $allocated_ms_unit_id . "',
                                                old_allocated_ms_unit_id ='" . $checkAllocationData[0]['allocated_ms_unit_id'] . "',
                                                remarks_for_manual_allocation ='" . $remarks . "',
                                                    allocated_choice_number= 
                                                    CASE 
                                                    WHEN choice1_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 1 
                                                    WHEN choice2_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 2
                                                    WHEN choice3_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 3
                                                    WHEN choice4_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 4
                                                    WHEN choice5_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 5
                                                        ELSE 0
                                                    END
                                            where regimental_number = '" . $regimental_number . "'";
                $connection->execute($updateEmployeeManualAllocation);

                $employeeInformations = $this->getJebDataForAllocataion($reg_no);
                //debug($employeeInformations);die;
                if (!empty($employeeInformations->toArray())) {
                    $this->set(compact('employeeInformations'));
                } else {
                    $this->Flash->error(__('The Regimental Number not found.'));
                }
            }
            $msUnits = $this->getUnits($employeeInformations->toArray()[0]['ms_rank_id'], $employeeInformations->toArray()[0]['ms_cadre_id']);
            $this->set(compact('msUnits'));
        }
    }

    public function recommendTreatCat() {
        if ($this->request->is('post')) {
            $reg_no = ['regimental_number' => $this->request->data['regimental_number']];
            $employeeInformations = $this->getJebDataForAllocataion($reg_no)->toArray();
            $msTreatmentCategoriesTable = TableRegistry::get('TreatmentCategories');
            $treatmentCategory = $msTreatmentCategoriesTable->find('list', ['keyField' => 'id', 'valueField' => ['description']])->toArray();

            // Show detail of employee
            if ($this->request->data['btn'] == 'SHOW DETAILS') {
                if (!empty($employeeInformations)) {
//                  debug($employeeInformations);
                } else {
                    $this->Flash->error(__('The Regimental Number not found.'));
                }
            }
            // Update Treatment Category
            if ($this->request->data['btn'] == 'Update Treatment Category') {
                $connection = ConnectionManager::get('default');
                // update query for treatment category
                $updateEmployeeTreatmentCategoryQuery = "
                    UPDATE employee_informations
                                            SET 
                    recommended_treatment_category_id= " . $this->request->data['recommended_treatment_category_id'] .
                        "where regimental_number ='" . $this->request->data['regimental_number'] . "'";
                $connection->execute($updateEmployeeTreatmentCategoryQuery);

                if (!empty($employeeInformations)) {
                    //$this->set(compact('employeeInformations'));
                } else {
                    $this->Flash->error(__('The Regimental Number not found.'));
                }
            }
        }

        $this->set(compact('treatmentCategory', 'employeeInformations'));
    }

    public function getUnits($rank_id, $cadre_id) {
        $msUnitsTable = TableRegistry::get('Vacancies');
        $msUnits = $msUnitsTable->find('list', ['keyField' => 'ms_unit_id', 'valueField' => ['description', 'live_vacancy']])
                ->where(['ms_rank_id' => $rank_id, 'ms_cadre_id' => $cadre_id]);

        return $msUnits;
    }

    public function bulkUpload() {


        $connection = ConnectionManager::get('default');

        $selectEmployeesList = "Select regimental_number,allocated_ms_unit_id,remarks_for_manual_allocation from manual_updated";
        $empDetailsList = $connection->execute($selectEmployeesList)->fetchAll('assoc');
        if (!empty($empDetailsList)) {
            foreach ($empDetailsList as $empList) {
                $allocated_ms_unit_id = $empList['allocated_ms_unit_id'];
                $remarks = $empList['remarks_for_manual_allocation'];
                $regimental_number = $empList['regimental_number'];

                $updateVacancies = "Select allocated_ms_unit_id,ms_rank_id,ms_cadre_id,ms_current_unit_id from employee_informations                                            
                                    where regimental_number = '" . $regimental_number . "'";
                $checkAllocationData = $connection->execute($updateVacancies)->fetchAll('assoc');

                $ms_rank_id = $checkAllocationData[0]['ms_rank_id'];
                $ms_cadre_id = $checkAllocationData[0]['ms_cadre_id'];
                $ms_current_unit_id = $checkAllocationData[0]['ms_current_unit_id'];

                //debug($checkAllocationData[0]['allocated_ms_unit_id']);
                // die;
                if (!empty($checkAllocationData[0]['allocated_ms_unit_id'])) {
                    //Update previous vacancies of unit
                    $updatePreviousVacancies = "UPDATE vacancies
                                            SET 
                                            manual_allocation_count =
                                            CASE 
                                                    WHEN 
                                                        manual_allocation_count = 0 
                                                    THEN 
                                                        0                                                    
                                                    ELSE  
                                                        manual_allocation_count-1
                                             END,
                                                live_vacancy = live_vacancy+1,
                                                transfer_in=transfer_in-1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $checkAllocationData[0]['allocated_ms_unit_id'] . "'";
                    $connection->execute($updatePreviousVacancies);

                    //update current unit vacancies
                    $updateVacancies = "UPDATE vacancies
                                            SET manual_allocation_count = manual_allocation_count+1,
                                                live_vacancy = live_vacancy-1,
                                                transfer_in=transfer_in+1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $allocated_ms_unit_id . "'";
                    $connection->execute($updateVacancies);
                } else {
                    //update current unit vacancies only
                    $updateVacancies = "UPDATE vacancies
                                            SET manual_allocation_count = manual_allocation_count+1,
                                                live_vacancy = live_vacancy -1,
                                                transfer_in=transfer_in+1
                                    where ms_rank_id ='" . $ms_rank_id . "' and ms_cadre_id= '" . $ms_cadre_id . "' and ms_unit_id= '" . $allocated_ms_unit_id . "'";
                    $connection->execute($updateVacancies);
                    $employeeInformations = $this->getJebDataForAllocataion($options);
                    $checkAllocationData[0]['allocated_ms_unit_id'] = 0;
                }

                //Update employee data
                $updateEmployeeManualAllocation = "UPDATE employee_informations
                                            SET 
                                                manual_allocation=false,                                            
                                                allocated_ms_unit_id ='" . $allocated_ms_unit_id . "',
                                                old_allocated_ms_unit_id ='" . $checkAllocationData[0]['allocated_ms_unit_id'] . "',
                                                remarks_for_manual_allocation ='" . $remarks . "',
                                                    allocated_choice_number= 
                                                    CASE 
                                                    WHEN choice1_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 1 
                                                    WHEN choice2_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 2
                                                    WHEN choice3_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 3
                                                    WHEN choice4_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 4
                                                    WHEN choice5_ms_unit_id='" . $allocated_ms_unit_id . "' THEN 5
                                                        ELSE 0
                                                    END
                                            where regimental_number = '" . $regimental_number . "'";
                $connection->execute($updateEmployeeManualAllocation);
            }
        }
    }

    public function getPoints() {
        $this->viewBuilder()->setLayout(false);
        $this->response->disableCache();
        $this->response->modified('now');
        $this->response->checkNotModified($this->request);
        $regimental_number = $_GET['id'];
        $table = TableRegistry::get("RulePoints");
        $ruleList = $table->find('all')
                ->contain(['CaseRules', 'CaseRules.CaseTypes'])
                ->select(['CaseRules.description', 'CaseRules.point', 'point', 'rule_points', 'no_of_months'])
                ->where(["regimental_number" => $regimental_number]);
        // echo json_encode(compact('ruleList'));die;

        $i = 0;
        foreach ($ruleList as $ruleListval) {
            // debug($ruleListval);
            $data[$i][] = $ruleListval->case_rule->description;
            $data[$i][] = $ruleListval->rule_points;
            if ($ruleListval->no_of_months == '1') {
                $data[$i][] = 'NA';
            } else {
                $data[$i][] = $ruleListval->no_of_months;
            }

            $data[$i][] = $ruleListval->point;
            $i++;
        }
        //debug($data);die;
//debug($ruleList->toArray());
//die;
        $this->set([
            'my_response' => $data,
            '_serialize' => 'my_response',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function AjaxGetEmployeeDetails() {
        $this->viewBuilder()->autoLayout(false);
        $regimental_number = $_REQUEST['id'];

        $options = ['regimental_number' => $regimental_number];
        $employeeInformations = $this->getJebDataForAllocataion($options);
        // debug($employeeInformations);die;
        $this->set(compact('employeeInformations'));
    }

    public function ajaxFreezeList() {
        $this->viewBuilder()->autoLayout(false);
        $venueTimeListArr = '';
        $rank_id = $_REQUEST['rank_id'];
        $cadre_id = $_REQUEST['cadre_id'];
        $type_id = $_REQUEST['type_id'];
        $list_type_options = ['0' => 'ALL', '1' => 'General Cases', '2' => 'Terminal Posting', '3' => 'LMC', '4' => 'Couple Case', '5' => 'Medical Ground (Only for self illness of Force Member)', '6' => 'Compassionate Ground'];
        $options = ['EmployeeInformations.ms_rank_id' => $rank_id,
            'EmployeeInformations.ms_cadre_id' => $cadre_id,
            'EmployeeInformations.is_active' => true, 'EmployeeInformations.headquaters_status' => '1'];
        if ($type_id == '0') {
            
        }
        if ($type_id == '1') {
            $options['whether_terminal_case'] = FALSE;
            $options['whether_unfit_for_haa_cold_climate'] = FALSE;
            $options['whether_couple_case'] = FALSE;
            $options['whether_medical_ground_case'] = FALSE;
            $options['whether_compassionate_case'] = FALSE;
        }
        if ($type_id == '2') {
            $options['whether_terminal_case'] = true;
        }
        if ($type_id == '3') {
            $options['whether_unfit_for_haa_cold_climate'] = true;
        }
        if ($type_id == '4') {
            $options['whether_couple_case'] = true;
        }
        if ($type_id == '5') {
            $options['whether_medical_ground_case'] = true;
        }
        if ($type_id == '6') {
            $options['whether_compassionate_case'] = true;
        }
        $connection = ConnectionManager::get('default');
        $tableGeneration = "update cadre_ranks set freeze_status=true where ms_rank_id='" . $rank_id . "' and ms_cadre_id='" . $cadre_id . "'";
        $connection->execute($tableGeneration);
        $jebLists = $this->getJebDataForAllocataion($options);

        $count_choice_requested = 0;
        $count_choice_given = 0;
        foreach ($jebLists as $key => $value) {

            if ($value['choice1_ms_unit_id'] != null) {
                $count_choice_requested++;
                if ($value['allocated_choice_number'] != null) {
                    $count_choice_given++;
                }
            }
        }

        $total = $jebLists->count();
//        $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        if($count_choice_requested != null) {
            $percentage = round(($count_choice_given / $count_choice_requested) * 100, 0);
        } else {
            $percentage = 0;
        }
        
        $rankTable = TableRegistry::get('MsRanks');
        $rankDesc = $rankTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $rank_id])->toArray();

        $cadresTable = TableRegistry::get('MsCadres');
        $cadreDesc = $cadresTable
                        ->find('all')
                        ->select(['description'])
                        ->where(['id' => $cadre_id])->toArray();
        //debug($cadreDesc[0]->description);die;

        $listname = 'Jeb 2020 List of ' . $rankDesc[0]->description . '/' . $cadreDesc[0]->description;
        $this->set(compact('jebLists', 'total', 'count_choice_requested', 'count_choice_given', 'percentage', 'listname'));
    }

    public function AjaxFinalAllocationCheck() {
        $this->viewBuilder()->autoLayout(false);
        $ms_rank_id = $_REQUEST['ms_rank_id'];
        $ms_cadre_id = $_REQUEST['ms_cadre_id'];
        $table = TableRegistry::get("CadreRanks");
        $status = $table->find('all')
                ->select(['freeze_status'])
                ->where(["ms_rank_id" => $ms_rank_id, "ms_cadre_id" => $ms_cadre_id]);
        $check = $status->toArray()[0]['freeze_status'];
        if ($check == true) {
            echo "1";
        } else {
            echo "0";
        }

        die;
    }

    public function AjaxShowPosted() {
        $this->viewBuilder()->autoLayout(false);
        $connection = ConnectionManager::get('default');
        $query = "select mu.description,unit_id,
            COALESCE(total_strength,0) as total_strength,
            COALESCE(current_out_from_hs,0) as current_out_from_hs,
            COALESCE(home_state_allocated,0)as home_state_allocated,
            COALESCE(home_state_posted,0) as home_state_posted,
            (COALESCE(home_state_allocated,0)+COALESCE(home_state_posted,0)-COALESCE(current_out_from_hs,0)) as total_posted,
            round((round((COALESCE(home_state_allocated,0)+COALESCE(home_state_posted,0)-COALESCE(current_out_from_hs,0)),2)*100/COALESCE(total_strength,0)),2) as percentage_posted 
            from ms_units as mu
left join 
(
	select * from 
	(
		select v.ms_unit_id as unit_id,sum(sanctioned_post) as total_strength  from vacancies as v
		group by v.ms_unit_id
	) as v
		left join 
	(
		select ei.allocated_ms_unit_id, count(ei.allocated_ms_unit_id)  as home_state_allocated
		from employee_informations as ei
		left join ms_units as mu
		on mu.ms_state_id=ei.home_ms_state_id and mu.id=ei.allocated_ms_unit_id
		where allocated_ms_unit_id is not null 
		and headquaters_status='1'
		group by ei.allocated_ms_unit_id
		order by ei.allocated_ms_unit_id
	) as b
	on v.unit_id=b.allocated_ms_unit_id
	left join 
	(

		select ei.ms_current_unit_id 
		,count(ei.ms_current_unit_id)  as current_out_from_hs
		from ms_units as mu
		left join employee_informations as ei
		on mu.id=ei.ms_current_unit_id and mu.ms_state_id=ei.home_ms_state_id
			where ms_current_unit_id is not null 
			and headquaters_status='1'
			group by ei.ms_current_unit_id
			order by ei.ms_current_unit_id
			
		
	) as c
	on v.unit_id=c.ms_current_unit_id
) as all_query
on mu.id=unit_id
where total_strength !=0
order by mu.id";
        $data = $connection->execute($query)->fetchAll('assoc');
//        debug($result_data);
//        die;
        $this->set(compact('data'));
    }

}
