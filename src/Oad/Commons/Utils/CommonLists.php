<?php

namespace App\Oad\Commons\Utils;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\Oad\Commons\Utils\ConstantValues;
use App\Oad\Commons\Utils\rulesList;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\I18n\Date;
use PDO;
define('BYE_PLAYER_ID', 999999999);


class CommonLists {
    

    public function getBracket($participants) {
        $participantsCount = count($participants);
        $rounds = ceil(log($participantsCount) / log(2));
        $bracketSize = pow(2, $rounds);
        $requiredByes = $bracketSize - $participantsCount;
//        echo sprintf('Number of participants: %d<br/>%s', $participantsCount, PHP_EOL);
//        echo sprintf('Number of rounds: %d<br/>%s', $rounds, PHP_EOL);
//        echo sprintf('Bracket size: %d<br/>%s', $bracketSize, PHP_EOL);
//        echo sprintf('Required number of byes: %d<br/>%s', $requiredByes, PHP_EOL);
        if ($participantsCount < 2) {
            return array();
        }
        $matches = array(array(1, 2));
        for ($round = 1; $round < $rounds; $round++) {
            $roundMatches = array();
            $sum = pow(2, $round + 1) + 1;
            foreach ($matches as $match) {
                $home = $this->changeIntoBye($match[0], $participantsCount);
                $away = $this->changeIntoBye($sum - $match[0], $participantsCount);
                $roundMatches[] = array($home, $away);
                $home = $this->changeIntoBye($sum - $match[1], $participantsCount);
                $away = $this->changeIntoBye($match[1], $participantsCount);
                $roundMatches[] = array($home, $away);
            }
            $matches = $roundMatches;
        }
        return $matches;
    }

    public function changeIntoBye($seed, $participantsCount) {
        //return $seed <= $participantsCount ?  $seed : sprintf('%d (= bye)', $seed);  
        return $seed <= $participantsCount ? $seed : null;
    }

    public function finalPlayerList($totalPlayers = null, $playerList = null) {
        //debug($playerList);
        //define('NUMBER_OF_PARTICIPANTS', $totalPlayers);
        $participants = range(1, $totalPlayers);
        $bracket = $this->getBracket($participants);
        $i = 0;
        foreach ($bracket as $key => $value) {
            foreach ($value as $key1 => $value1) {

                if ($value1 == null) {
                    $newArray[$i] = null;
                } else {
                    $newArray[$i] = $value1;
                }
                $i++;
            }
        }
        $random = BYE_PLAYER_ID;
        foreach ($newArray as $key => $value) {
            if ($value != null) {
                $newArray[$key] = array_pop($playerList);
            } else {
                //$newArray[$key] = null;
                $newArray[$key] = $random;
                $random++;
            }
        }
        $finalPlayerlist = $newArray;
        //debug($finalPlayerlist);
        return $finalPlayerlist;
    }

    //code for generating sequence number
    public function getRegNoSeq($state_id) {
        $connection = ConnectionManager::get('default');
        $resourceTypeQuery1 = "select nextval('registration_number')";

        $result = $connection->execute($resourceTypeQuery1)->fetch();

        $new_state_id = $state_id < 10 ? '0' . $state_id : $state_id;
        $ref_no = 'SOA-' . $new_state_id . '-' . $result[0];
        //$advid
        return $ref_no;
    }

    public function getAllEventActivityList($id = null) {
        //debug($id);
        $Table = TableRegistry::get('EventActivityLists');
        $lists = $Table->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['event_lists_id' => $id, 'active' => true])->order('description');
        //debug($lists->toarray());die;
        return $lists;
    }

    public function ajaxGetAllEventActivityList($id) {

        $Table = TableRegistry::get('RegisterCandidates');
        $List = $Table
                //->find('all')
                ->find('list', ['keyField' => 'state_list_id', 'valueField' => 'StateLists.description'])
                ->contain(['stateLists'])
                ->distinct(['state_list_id'])
                ->where(['event_activity_list_id' => $id, 'RegisterCandidates.active' => true]);
        $ListArr = '';
        $ListArr .= '<option value="">----Select----</option>';
        if (!empty($List) && isset($List)) {
            foreach ($List as $key => $value) {
                $ListArr .= '<option value="' . $key . '">' . $value . '</option>';
            }
        } else {
            $ListArr = 0;
        }
        echo $ListArr;
        exit;
    }

//    public function getAllEventActivityStateList($id = null) {
//        //debug($id);
//        $Table = TableRegistry::get('RegisterCandidates');
//        $lists = $Table
//                //->find('all')
//                ->find('list', ['keyField' => 'state_list_id', 'valueField' => 'StateLists.description'])
//                ->contain(['stateLists'])
//                ->distinct(['state_list_id']) 
//                ->where(['event_activity_list_id' => $id, 'RegisterCandidates.active' => true]);
//        //debug($lists->toarray());
//        //debug($lists);die;
//        return $lists;
//    }

    public function getAllCadres() {
        $MsCadresTable = TableRegistry::get('MsCadres');
        $msCadres = $MsCadresTable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        return $msCadres;
    }

    /**
     * 
     * @return type
     */
    public function getAllCadreRanks() {
        $CadreRanksTable = TableRegistry::get('CadreRanks');
        $CadresRanks = $CadreRanksTable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        return $CadresRanks;
    }

    /**
     * 
     * @param type $ms_rank_id
     * @return type
     */
    public function ajaxGetRankCadre($id) {

        $Table = TableRegistry::get('CadreRanks');
        $List = $Table
                        ->find('list', ['keyField' => 'ms_cadre_id', 'valueField' => 'MsCadres.description'])
                        ->contain(['msCadres'])
                        ->where(['ms_rank_id' => $id, 'msCadres.is_active' => true])->order('description');
        $ListArr = '';
        $ListArr .= '<option value="">----Select----</option>';
        if (!empty($List) && isset($List)) {
            foreach ($List as $key => $value) {
                $ListArr .= '<option value="' . $key . '">' . $value . '</option>';
            }
        } else {
            $ListArr = 0;
        }
        echo $ListArr;
        exit;
    }

    public function getRankCadre($id) {

        $Table = TableRegistry::get('CadreRanks');
        $List = $Table
                        ->find('list', ['keyField' => 'ms_cadre_id', 'valueField' => 'MsCadres.description'])
                        ->contain(['msCadres'])
                        ->where(['ms_rank_id' => $id, 'msCadres.is_active' => true])->order('description');

        return $List;
    }

    public function ajaxGetFrontierUnits($id) {

        $Table = TableRegistry::get('MsUnits');
        $List = $Table
                        ->find('list', ['keyField' => 'id', 'valueField' => 'description'])
                        //->contain(['msFrontiers'])
                        ->where(['ms_frontier_id' => $id, 'allowed_choice_unit' => true, 'is_active' => true])->order('description');

        $ListArr = '';
        $ListArr .= '<option value="">----Select----</option>';
        if (!empty($List) && isset($List)) {
            foreach ($List as $key => $value) {
                $ListArr .= '<option value="' . $key . '">' . $value . '</option>';
            }
        } else {
            $ListArr = 0;
        }
        echo $ListArr;
        exit;
    }

    public function monthBtwTwoDates($from_date, $to_date) {
        $begin = new \DateTime($from_date);
        $end = new \DateTime($to_date);
        //$end = $end->modify('+1 month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($begin, $interval, $end);
        $counter = 0;
        foreach ($period as $dt) {
            $counter++;
        }
        return $counter;
    }

    public function updatePoints($regimental_number, $points) {
        $connection = ConnectionManager::get('default');
        //$updateCurrentPasswordString="update itbp.user_auth set password='".$newPassword."', password1='".$oldPassword."' where user_name='".$uName."'";
        $queryString = "update employee_informations set point_assigned='" . $points . "' where regimental_number='" . $regimental_number . "'";
        //$connection->execute($queryString);
        if ($connection->execute($queryString)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEditedVacancy($ms_rank_id, $ms_cadre_id, $ms_unit_id) {

        $List = $this->vacancyStatement($ms_rank_id, $ms_cadre_id, $ms_unit_id);

        if (empty($List)) {
            return false;
        }

        $sanctioned_post = $List['0']->sanctioned_post;
        $posted = $List['0']->posted;

        $vacancy = $sanctioned_post - $posted;
        //previous transfer out
        $transfer_out = $List['0']->transfer_out;
        //updated transfer out after this change
        $transfer_out = $transfer_out + 1;
        //updated vacancy after transfer out
        $vacancy_after_transfer_out = $vacancy + $transfer_out;

        $connection = ConnectionManager::get('default');
        $queryString = "update vacancies set
                 vacancy=sanctioned_post-posted,
                 transfer_out=transfer_out-1,
                 vacancy_after_transfer_out= vacancy + transfer_out-1                 
                where ms_rank_id='" . $ms_rank_id . "' and ms_cadre_id='" . $ms_cadre_id . "' and ms_unit_id='" . $ms_unit_id . "'";

        if ($connection->execute($queryString)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSingleVacancy($ms_rank_id, $ms_cadre_id, $ms_unit_id) {

        $List = $this->vacancyStatement($ms_rank_id, $ms_cadre_id, $ms_unit_id);
        if (empty($List)) {
            return false;
        }

        $sanctioned_post = $List['0']->sanctioned_post;
        $posted = $List['0']->posted;

        $vacancy = $sanctioned_post - $posted;
        //previous transfer out
        $transfer_out = $List['0']->transfer_out;
        //updated transfer out after this change
        $transfer_out = $transfer_out + 1;
        //updated vacancy after transfer out
        $vacancy_after_transfer_out = $vacancy + $transfer_out;

        $connection = ConnectionManager::get('default');
        $queryString = "update vacancies set
                 vacancy=sanctioned_post-posted,
                 transfer_out=transfer_out+1,
                 vacancy_after_transfer_out= vacancy+  transfer_out                 
                where ms_rank_id='" . $ms_rank_id . "' and ms_cadre_id='" . $ms_cadre_id . "' and ms_unit_id='" . $ms_unit_id . "'";

        if ($connection->execute($queryString)) {
            return true;
        } else {
            return false;
        }
    }

    public function convertPreviousPostingsTable($table_name, $data) {

        if (isset($table_name) && isset($data)) {
            $i = 0;
            foreach ($data['ms_unit_id'] as $key => $value) {
                foreach ($data as $key1 => $value1) {
                    $data_new[$i]['ms_unit_id'] = $data['ms_unit_id'][$i];
                    $data_new[$i]['ms_location_id'] = $data['ms_location_id'][$i];
                    $data_new[$i]['from_date'] = $data['from_date'][$i];
                    $data_new[$i]['to_date'] = $data['to_date'][$i];
                    $data_new[$i]['ms_unit_category_id'] = $data['ms_unit_category_id'][$i];
                    $data_new[$i]['posting_number'] = $i;
                }
                $i++;
            }
            return $data_new;
        }
    }

    public function getEmployeeData($regimental_number) {
        $Table = TableRegistry::get('EmployeeInformations');
        $List = $Table
                ->find('All')
                ->contain([
                    'MsNameOfBranches',
                    'MsGenders',
                    'MsRanks',
                    'MsCadres',
                    'MsCurrentUnits',
                    'MsCurrentUnits.MsLocations',
                    'MsCurrentUnits.MsStates',
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
                    'SpouseCurrentMsUnits',
                    'AllocatedMsUnits',
                    'Choice1MsUnits',
                    'Choice2MsUnits',
                    'Choice3MsUnits',
                    'Choice4MsUnits',
                    'Choice5MsUnits',
                    'PatientDetails',
                    'PreviousPostings',
                    'QualifiedCourses'
                ])
                ->where([
            'EmployeeInformations.regimental_number' => $regimental_number
        ]);
        $dataObject = $List->toArray();
//         if($dataObject['regimental_number']=='100130021'){
//             debug($regimental_number);
//            debug($dataObject);
//            die;
//        }
        $dataObject = $dataObject['0'];

        return $dataObject;
    }

    public function assignPointsToEmployee($regimental_number) {
        $this->deleteRulePoints($regimental_number);
        $total_points = $this->JebPointsConditions($regimental_number);
//debug($total_points);die;
        if ($this->updatePoints($regimental_number, $total_points)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * if posted in Home State/SA & completed more than 3 years tenure in current unit.
     * @param type $home_state_check
     * @return type
     */
    public function JebPointsConditions($regimental_number) {

        $terminal_posting_case_points = 0;
        $lmc_case_points = 0;
        $couple_case_points = 0;
        $medical_ground_case_points = 0;
        $compassionate_case_points = 0;

        $data = $this->getEmployeeData($regimental_number);
        $generalData = $this->setGeneralData($data);
//General Cases rules
        //General case Points
        $generalCasePoints = $this->generalCase($generalData);

        //terminal case Points
        $terminal_posting_case = $data['whether_terminal_case'];
        if ($terminal_posting_case == 'true') {
            $terminal_posting_case_points = $this->terminalPostingCase($generalData);
        }
        //lmc case Points
        $lmc_case = $data['whether_couple_case'];
        if ($lmc_case == 'true') {
            $lmc_case_points = $this->lmcCase($generalData);
        }
        //couple case Points
        $whether_couple_case = $data['whether_couple_case'];
        if ($whether_couple_case == 'true') {
            $couple_case_points = $this->coupleCase($generalData);
        }
        //Medical ground case Points
        $whether_medical_ground_case = $data['whether_medical_ground_case'];
        if ($whether_medical_ground_case == 'true') {
            $medical_ground_case_points = $this->medicalGroundCase($generalData);
        }
        //Compassionate cases Points
        $whether_compassionate_case = $data['whether_compassionate_case'];
        if ($whether_compassionate_case == 'true') {
            $compassionate_case_points = $this->compassionateGroundCase($generalData);
        }

        $totalPoints = $generalCasePoints + $terminal_posting_case_points +
                $lmc_case_points + $couple_case_points +
                $medical_ground_case_points +
                $compassionate_case_points;

        //debug($total_points);
//        debug($data);

        return $totalPoints;
    }

    public function setGeneralData($data) {


        if ($data['ms_current_unit']['ms_location']->description == 'Leh') {
            $generalData['currently_posted_in_leh_unit'] = true;
        } else {
            $generalData['currently_posted_in_leh_unit'] = false;
        }
        $generalData['regimental_number'] = $data['regimental_number'];
        $generalData['period_of_total_service_rendered_in_ha'] = $data['period_of_total_service_rendered_in_ha'];
        $generalData['period_of_total_service_rendered_in_sa'] = $data['period_of_total_service_rendered_in_sa'];
        $generalData['period_of_total_service_rendered_in_eha'] = $data['period_of_total_service_rendered_in_eha'];

        //continuous months

        if ($data['continuous_ms_unit_category_id'] == null) {
            $generalData['continuous_ms_unit_category_id'] = $data['continuous_ms_unit_category_id'];
            $generalData['continuous_ms_unit_category'] = null;
        } else {
            $generalData['continuous_ms_unit_category_id'] = $data['continuous_ms_unit_category_id'];
            $generalData['continuous_ms_unit_category'] = $data['continuous_ms_unit_category']['description'];
        }
        $generalData['no_of_months_completed_continuously'] = $data['no_of_months_completed_continuously'];

        $generalData['home_state_id'] = $data['home_ms_state_id'];
        $generalData['is_presently_posted_in_home_state'] = $data['is_presently_posted_in_home_state'];

        $generalData['current_unit_id'] = $data['ms_current_unit_id'];
        $generalData['no_of_months_in_current_unit'] = $data['no_of_months_in_current_unit'];
        $generalData['current_unit_category'] = $data['current_ms_unit_category']['description'];
        $generalData['home_state_id_of_current_unit'] = $data['ms_current_unit']['ms_state']['id'];

        //LMC
        $generalData['ms_medical_category_description'] = $data['ms_medical_category']['description'];
        $generalData['whether_unfit_for_haa_cold_climate'] = $data['whether_unfit_for_haa_cold_climate'];


        $generalData['home_ms_state_description'] = $data['home_ms_state']['description'];
        $generalData['type_of_grievance_id'] = $data['type_of_grievance_id'];
//debug($generalData);die;
        return $generalData;
    }

    public function generalCase($data) {
        $totalgeneralPoints = 0;
        $totalgeneralPoints = GeneralRulesList::getRule1($data);
        $totalgeneralPoints += GeneralRulesList::getRule2($data);
        $totalgeneralPoints += GeneralRulesList::getRule3($data);
        $totalgeneralPoints += GeneralRulesList::getRule4($data);
        $totalgeneralPoints += GeneralRulesList::getRule5($data);
        $totalgeneralPoints += GeneralRulesList::getRule6($data);
        $totalgeneralPoints += GeneralRulesList::getRule7($data);
        $totalgeneralPoints += GeneralRulesList::getRule8($data);

        return $totalgeneralPoints;
    }

    public function terminalPostingCase($data) {
        debug($data);
        die;
        $totalterminalPoints = 0;
        $totalterminalPoints += TerminalCaseRulesList::getRule1($data);
        $totalterminalPoints += TerminalCaseRulesList::getRule2($data);
        $totalterminalPoints += TerminalCaseRulesList::getRule3($data);
        $totalterminalPoints += TerminalCaseRulesList::getRule4($data);
        $totalterminalPoints += TerminalCaseRulesList::getRule5($data);

        return $totalterminalPoints;
    }

    public function lmcCase($data) {
        $totalLmcCasePoints = 0;
        $totalLmcCasePoints += LmcCaseRulesList::getRule1($data);

        return $totalLmcCasePoints;
    }

    public function coupleCase($data) {
        $totalCoupleCasePoints = 0;
        $totalCoupleCasePoints += CoupleCaseRulesList::getRule1($data);

        return $totalCoupleCasePoints;
    }

    public function medicalGroundCase($data) {
        $totalMedicalGroundCasePoints = 0;
        $totalMedicalGroundCasePoints += MedicalGroundCaseRulesList::getRule1($data);

        return $totalMedicalGroundCasePoints;
    }

    public function compassionateGroundCase($data) {
        $totalCompassionateCasePoints += CompassionateGroundCaseRulesList::getRule1($data);

        return $totalCompassionateCasePoints;
    }

    public function allocateUnit($dataAllocation) {

        $regimental_number = $dataAllocation['regimental_number'];
        $ms_rank_id = $dataAllocation['ms_rank_id'];
        $ms_cadre_id = $dataAllocation['ms_cadre_id'];
        $current_unit_id = $dataAllocation['ms_current_unit_id'];
        $current_ms_unit_category_id = $dataAllocation['current_ms_unit_category_id'];
        $choice1_unit = $dataAllocation['choice1_ms_unit_id'];
        $choice2_unit = $dataAllocation['choice2_ms_unit_id'];
        $choice3_unit = $dataAllocation['choice3_ms_unit_id'];
        $choice4_unit = $dataAllocation['choice4_ms_unit_id'];
        $choice5_unit = $dataAllocation['choice5_ms_unit_id'];

        if ($current_ms_unit_category_id == '2') {
            //EHA
            $allow_category = 3;
        } elseif ($current_ms_unit_category_id == '3') {
            //HA
            $allow_category = 2;
        } elseif ($current_ms_unit_category_id == '4') {
            //SA
            $allow_category = 3;
        }

        if (!empty($choice1_unit)) {
            if ($this->tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice1_unit, 1, $current_unit_id)) {
                return true;
            }
        } else {

            if ($this->tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, 0, $current_unit_id)) {
                return true;
            }
        }
        if (!empty($choice2_unit)) {
            if ($this->tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice2_unit, 2, $current_unit_id)) {
                return true;
            }
        } else {
            if ($this->tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, 0, $current_unit_id)) {
                return true;
            }
        }
        if (!empty($choice3_unit)) {
            if ($this->tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice3_unit, 3, $current_unit_id)) {
                return true;
            }
        } else {
            if ($this->tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, 0, $current_unit_id)) {
                return true;
            }
        }
        if (!empty($choice4_unit)) {
            if ($this->tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice4_unit, 4, $current_unit_id)) {
                return true;
            }
        } else {
            if ($this->tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, 0, $current_unit_id)) {
                return true;
            }
        }
        if (!empty($choice5_unit)) {
            if ($this->tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice5_unit, 5, $current_unit_id)) {
                return true;
            }
        } else {
            if ($this->tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, 0, $current_unit_id)) {
                return true;
            }
        }


        return false;
    }

    public function tryAllocationForChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $choice_unit, $choice_number, $current_unit) {
        //get vacancy of particular rank, cadre, unit
        $vacancyStatement = $this->vacancyStatement($ms_rank_id, $ms_cadre_id, $choice_unit);
        //check if it is empty else return false
        // debug($vacancyStatement);die;
        if (!empty($vacancyStatement)) {
//            $vacancy = $vacancyStatement['0']->vacancy;
            $vacancy_after_transfer_out = $vacancyStatement['0']->vacancy_after_transfer_out;
//            $vacancy_after_transfer_in = $vacancyStatement['0']->vacancy_after_transfer_in;
//            $transfer_out = $vacancyStatement['0']->transfer_out;
//            $transfer_in = $vacancyStatement['0']->transfer_in;
            // if there is vacancy after for more after transfer out
            if ($vacancy_after_transfer_out > 0) {
                if ($this->updateChoiceVacancyIn($regimental_number, $ms_rank_id, $ms_cadre_id, $choice_unit, $choice_number, $current_unit)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function tryAllocationForNoChoice($regimental_number, $ms_rank_id, $ms_cadre_id, $allow_category, $current_unit) {
        //get vacancy of particular rank, cadre, unit
        $vacancyStatement = $this->getHighestVacancyCategoryWise($ms_rank_id, $ms_cadre_id, $allow_category);
        //debug($vacancyStatement); die;
        //check if it is empty else return false
        if (!empty($vacancyStatement)) {
            $vacancy_after_transfer_out = $vacancyStatement->vacancy_after_transfer_out;
            $allocate_unit_in = $vacancyStatement->ms_unit_id;
            if ($vacancy_after_transfer_out > 0) {
                if ($this->updateChoiceVacancyIn($regimental_number, $ms_rank_id, $ms_cadre_id, $allocate_unit_in, 0, $current_unit)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateChoiceVacancyIn($regimental_number, $ms_rank_id, $ms_cadre_id, $ms_unit_id, $choice_number, $current_unit) {
        $connection = ConnectionManager::get('default');
        $queryString = "update vacancies set
                        transfer_in=transfer_in+1,
                        vacancy_after_transfer_in=vacancy_after_transfer_in-1
                        where ms_rank_id='" . $ms_rank_id . "' and ms_cadre_id='" . $ms_cadre_id . "' and ms_unit_id='" . $ms_unit_id . "'";

        //$connection->execute($queryString);
        if ($connection->execute($queryString)) {
            if ($this->updateAfterAllocation($regimental_number, $ms_unit_id, $choice_number)) {
                if ($this->updateChoiceVacancyOut($ms_rank_id, $ms_cadre_id, $current_unit)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateChoiceVacancyOut($ms_rank_id, $ms_cadre_id, $current_unit) {
        $connection = ConnectionManager::get('default');
        $queryString = "update vacancies set
                        vacancy_after_transfer_out=vacancy_after_transfer_out-1                  
                        where ms_rank_id='" . $ms_rank_id . "' and ms_cadre_id='" . $ms_cadre_id . "' and ms_unit_id='" . $current_unit . "'";

        //$connection->execute($queryString);
        if ($connection->execute($queryString)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAfterAllocation($regimental_number, $unit, $choice_number) {
        $connection = ConnectionManager::get('default');
        //$updateCurrentPasswordString="update itbp.user_auth set password='".$newPassword."', password1='".$oldPassword."' where user_name='".$uName."'";
        $queryString = "update employee_informations set allocated_ms_unit_id='" . $unit . "',allocated_choice_number='" . $choice_number . "' where regimental_number='" . $regimental_number . "'";
        //($queryString);
        if ($connection->execute($queryString)) {
            return true;
        } else {
            return false;
        }
    }

    public function vacancyStatement($ms_rank_id, $ms_cadre_id, $ms_unit_id) {
        $Table = TableRegistry::get('Vacancies');
        $List = $Table
                ->find('All')
                ->where([
            'ms_rank_id' => $ms_rank_id,
            'ms_cadre_id' => $ms_cadre_id,
            'ms_unit_id' => $ms_unit_id
        ]);
        return $List = $List->toArray();
    }

    public function getHighestVacancyCategoryWise($ms_rank_id, $ms_cadre_id, $allow_category) {
        $Table = TableRegistry::get('Vacancies');
        $List = $Table
                        ->find('All')
                        // ->select(['vacancy_after_transfer_out' => 'MAX(Vacancies.vacancy)','transfer_out'])
                        ->contain(['MsUnits'])
                        ->where([
                            'ms_rank_id' => $ms_rank_id,
                            'ms_cadre_id' => $ms_cadre_id,
                            'MsUnits.ms_unit_category_id' => $allow_category
                        ])->order(['Vacancies.vacancy' => 'desc'])->first();
        return $List;
    }

    public function updateTransferOutVacancyAll($ms_rank_id, $ms_cadre_id) {

        $Table = TableRegistry::get('EmployeeInformations');
        $Lists = $Table
                ->find('All')
                ->select(['ms_rank_id', 'ms_cadre_id', 'ms_current_unit_id'])
                ->where(['EmployeeInformations.ms_rank_id' => $ms_rank_id,
            'EmployeeInformations.ms_cadre_id' => $ms_cadre_id,
            'EmployeeInformations.headquaters_status' => '1',
            'EmployeeInformations.is_active' => true]);
        $connection = ConnectionManager::get('default');
        $queryString1 = "UPDATE vacancies SET vacancy = (SELECT sanctioned_post-posted FROM vacancies b WHERE vacancies.id = b.id) where ms_rank_id=" . $ms_rank_id . " and ms_cadre_id=" . $ms_cadre_id;

//debug($queryString1);die;
        if ($connection->execute($queryString1)) {
            //return true;
        } else {
            // return false;
            die;
        }

        $queryString2 = "update vacancies set vacancy_after_transfer_out=0,transfer_out=0,live_vacancy=vacancy,transfer_in=0,vacancy_after_transfer_in=0 where ms_rank_id=" . $ms_rank_id . " and ms_cadre_id=" . $ms_cadre_id;

        if ($connection->execute($queryString2)) {
            //return true;
        } else {
            //return false;
            die;
        }
        $queryString3 = "update employee_informations set manual_allocation=false, allocated_ms_unit_id=null ,allocated_choice_number=null where ms_rank_id=" . $ms_rank_id . " and ms_cadre_id=" . $ms_cadre_id;

        if ($connection->execute($queryString3)) {
            // return true;
        } else {
            // return false;
            die;
        }
        $queryString4 = "TRUNCATE allocation_reason RESTART IDENTITY";

        if ($connection->execute($queryString4)) {
            // return true;
        } else {
            // return false;
            die;
        }

        foreach ($Lists as $List) {

            $queryString5 = "update vacancies set
                        
                       live_vacancy=
                        CASE
                            WHEN sanctioned_post <= live_vacancy 
                                THEN  sanctioned_post 
                            ELSE vacancy+transfer_out+1 
                          END,
                        transfer_out=transfer_out+1,
                        vacancy_after_transfer_out=vacancy+transfer_out+1 
                        where ms_rank_id='" . $List->ms_rank_id . "' and ms_cadre_id='" . $List->ms_cadre_id . "' and ms_unit_id='" . $List->ms_current_unit_id . "'";

            if ($connection->execute($queryString5)) {
                // return true;
            } else {
                // return false;
                die;
            }
        }
        $queryStringreset = "update vacancies set 
            vacancy_after_transfer_out=transfer_out+vacancy,
                live_vacancy=
                CASE
                            WHEN  live_vacancy <= 0
                                THEN  0 
                            ELSE transfer_out+vacancy  
                          END
where ms_rank_id=" . $ms_rank_id . " and ms_cadre_id=" . $ms_cadre_id;

        if ($connection->execute($queryStringreset)) {
            //return true;
        } else {
            //return false;
            die;
        }
    }

    public function getContinuouslyServedMonths($dataSum, $no_of_months_in_current_unit, $current_ms_unit_category_id) {

        $i = 0;
        //debug($dataSum);
        $continuous_sum = $no_of_months_in_current_unit;
        $previous_unit_category_id = $current_ms_unit_category_id;
        foreach ($dataSum as $key => $value) {
            // debug($value['to_date']);die;
            // foreach ($dataSum as $key1 => $value1) {
            // echo "</br>";
            //}
            if (($value['ms_unit_category_id'] == '2' || $value['ms_unit_category_id'] == '3') && ($previous_unit_category_id == '2' || $previous_unit_category_id == '3')) {
                $no_of_months = $this->monthBtwTwoDates($value['from_date'], $value['to_date']);
                $continuous_sum = $continuous_sum + $no_of_months;
                //echo "</br>";
                $previous_unit_category_id = $value['ms_unit_category_id'];
                //echo "</br>";
            } else {
                // echo "</br>";                 ;
                $previous_unit_category_id = '0';
            }
            $i++;
        }

        return $continuous_sum;
    }

    public function updateMonths($ms_rank_id, $ms_cadre_id) {

        $Table = TableRegistry::get('EmployeeInformations');
        $Lists = $Table
                ->find('All')
                ->select(['regimental_number', 'ms_rank_id', 'ms_cadre_id', 'ms_current_unit_id', 'date_of_reporting_in_current_unit', 'current_ms_unit_category_id'
                    , 'continuous_ms_unit_category_id'])
                ->where([
            'EmployeeInformations.headquaters_status' => '1',
            'EmployeeInformations.is_active' => true
                //,'regimental_number'=>'860070216'
        ]);
        $connection = ConnectionManager::get('default');

        foreach ($Lists as $List) {
            $cuttoff_date = '2019-06-30';
            $no_of_months_in_current_unit = $this->monthBtwTwoDates($List['date_of_reporting_in_current_unit'], $cuttoff_date);
            if ($List['current_ms_unit_category_id'] == '3' || $List['current_ms_unit_category_id'] == '2') {
                $PreviousPostingsTable = TableRegistry::get('PreviousPostings');
                $PreviousPostingslist = $PreviousPostingsTable
                                ->find('All')
                                ->where(['regimental_number' => $List['regimental_number']])
                                ->order(['posting_number' => 'asc'])->toArray();
                $List['continuous_ms_unit_category_id'] = $List['current_ms_unit_category_id'];
                $no_of_months_completed_continuously = $this->getContinuouslyServedMonths($PreviousPostingslist, $no_of_months_in_current_unit, $List['current_ms_unit_category_id']);
            } else {
                $no_of_months_completed_continuously = $no_of_months_in_current_unit;
            }
            // debug($no_of_months_completed_continuously);die;

            $queryString5 = "update employee_informations set no_of_months_completed_continuously='" . $no_of_months_completed_continuously . "'
                            where regimental_number='" . $List['regimental_number'] . "'";

            if ($connection->execute($queryString5)) {
                // return true;
            } else {
                // return false;
                die;
            }
        }
    }

    public function checkAllocation($regimental_number_given, $rank_id, $cadre_id) {
//        $connection = ConnectionManager::get('default');
//        $regimental_number_array1 = array('930090168','080140326','080410867','077011448',
//                                            //'120210634',
//                                            '037040253','080360023',
//                                            //'870160012',
//                                            '120170036','070314992');
//        
//        if (in_array($regimental_number_given, $regimental_number_array1)) {
//             $to_given_unit_id = 55;
//             $this->allocate_check($regimental_number_given, $rank_id, $cadre_id, $to_given_unit_id);
//             //die;
//        }
        //$to_given_unit_id=55;
        //$this->allocateCheck($regimental_number_given, $rank_id, $cadre_id,$regimental_number_array1,$to_given_unit_id);
    }

    public function allocate_check($regimental_number_given, $rank_id, $cadre_id, $to_given_unit_id) {

        $Table = TableRegistry::get('EmployeeInformations');
        $List_given_to = $Table
                ->find('All')
                ->select(['allocated_ms_unit_id'])
                ->where(['regimental_number' => $regimental_number_given, 'ms_rank_id' => $rank_id, 'ms_cadre_id' => $cadre_id]);

        $List_given_to = $List_given_to->toArray();
        $given_unit_id = $List_given_to[0]->allocated_ms_unit_id;

        $List_taken_from = $Table
                ->find('All')
                ->select(['allocated_ms_unit_id', 'regimental_number', 'choice1_ms_unit_id'])
                ->where(['allocated_ms_unit_id' => $to_given_unit_id, 'ms_rank_id' => $rank_id, 'ms_cadre_id' => $cadre_id, 'choice1_ms_unit_id is null'])
                ->limit(1);
        $List_taken_from = $List_taken_from->toArray();

        if (!empty($List_taken_from[0]->allocated_ms_unit_id)) {
            $connection = ConnectionManager::get('default');
            $updateGiven = "UPDATE employee_informations
                                            SET allocated_ms_unit_id = '" . $List_taken_from[0]->allocated_ms_unit_id . "'
                                            where regimental_number = '" . $regimental_number_given . "'";
            $connection->execute($updateGiven);
            $updateTaken = "UPDATE employee_informations
                                            SET allocated_ms_unit_id ='" . $List_given_to[0]->allocated_ms_unit_id . "'
                                            where regimental_number = '" . $List_taken_from[0]->regimental_number . "'";
            $connection->execute($updateTaken);
        }
    }

    public static function getPointsTable($options, $regimental_number, $number_of_times) {
        $Table = TableRegistry::get('CaseRules');
        $List = $Table
                ->find('All')
                ->select(['id', 'point'])
                ->where([$options]);
        $List = $List->toArray();
        $case_rule_id = $List[0]->id;
        $point = $List[0]->point;

//        debug($point);
//        debug($number_of_times);

        $total_rule_points = $point * $number_of_times;
        // debug($total_rule_points);die;
        if (CommonLists::setRulePoints($regimental_number, $case_rule_id, $total_rule_points)) {
            
        } else {
            echo 'Error in setting points';
            die;
        }
        return $total_rule_points;
    }

    public static function setRulePoints($regimental_number, $case_rule_id, $total_rule_points) {
        $connection = ConnectionManager::get('default');
        $queryString1 = "insert into rule_points (case_rule_id,point,regimental_number,is_active,action_by,action_ip,created,modified)"
                . " values ('" . $case_rule_id . "' , '" . $total_rule_points . "', '" . $regimental_number . "', 'true', '" . $_SESSION['Auth']['User']['id'] . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'now()', 'now()')";

        if ($connection->execute($queryString1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteRulePoints($regimental_number) {
        $connection = ConnectionManager::get('default');
        $queryString1 = "delete from rule_points where regimental_number ='" . $regimental_number . "'";

        if ($connection->execute($queryString1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function myAuthorization($myId, $myRole) {
        $options = null;
        if ($myRole == 'superadmin') {
            $return = 'all';
            //$options = ['deo_user_id' => $myId];
        } elseif ($myRole == 'deoUnit') {
            $options = ['deo_user_id' => $myId];
        } elseif ($myRole == 'soUnit') {
            $options = ['so_user_id' => $myId];
        } elseif ($myRole == 'mainUnit') {
            $options = ['main_user_id' => $myId];
        } elseif ($myRole == 'esttUser') {
            $return = 'all';
        } elseif ($myRole == 'admin') {
            $return = 'all';
        } elseif ($myRole == 'user') {
            $return = 'all';
        }
        // debug($options);
        if ($options == null) {
            return $return;
        } else {
            $Table = TableRegistry::get('ReportingLists');
            $List = $Table
                    ->find('All')
                    ->select(['id', 'deo_user_id', 'so_user_id', 'main_user_id'])
                    ->where([$options]);
            $List = $List->toArray();
            // debug($List);
            if ($List == null) {
                $actionByList = $myId;
            } else {
                foreach ($List as $data) {
                    $actionByList[] = $data['deo_user_id'];
                    $actionByList[] = $data['so_user_id'];
                    $actionByList[] = $data['main_user_id'];
                }
            }

            //debug($actionByList);
            $options = ['EmployeeInformations.created_by in' => $actionByList];
//            debug($options);
//            die;
            return $actionByList;
        }
    }

}
