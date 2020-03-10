<?php

namespace App\Oad\Commons\Utils;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\Oad\Commons\Utils\ConstantValues;
use App\Oad\Commons\Utils\CommonLists;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\I18n\Date;
use PDO;

class GeneralRulesList {

    //-------------------------------General Cases-----------------------------------------------------------


    public static function getRule1($data) {
        //debug($data['regimental_number']);die;
        $points = 0;
        if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            // 	If posted in HA & completed 3 years & more but less than 5 years
            if ($data['no_of_months_completed_continuously'] >= 36 && $data['no_of_months_completed_continuously'] < 60) {
                $options = ['rule_number' => '1'];
                $points = CommonLists::getPointsTable($options, $data['regimental_number'], 1);
            }
        }
        return $points;
    }

    public static function getRule2($data) {

        $points = 0;
        if ($data['currently_posted_in_leh_unit'] == true) {
            //If posted in Leh based formation & completed 2 years & more but less than 5 years
            if ($data['no_of_months_in_current_unit'] >= 24 && $data['no_of_months_in_current_unit'] < 60) {
                $options = ['rule_number' => '2'];
                $points = CommonLists::getPointsTable($options, $data['regimental_number'], 1);
            }
        }

        return $points;
    }

    public static function getRule3($data) {
        $points = 0;
        //If posted in EHA & completed 3 years & more but less than 5 years
        if ($data['currently_posted_in_leh_unit'] == false) {
            if ($data['current_unit_category'] == 'EHA') {
                if ($data['no_of_months_in_current_unit'] >= 36 && $data['no_of_months_in_current_unit'] < 60) {
                    $options = ['rule_number' => '3'];
                    $points = CommonLists::getPointsTable($options, $data['regimental_number'], 1);
                }
            }
        }

        return $points;
    }

    public static function getRule4($data) {
        $points = 0;
//        if($data['regimental_number']=='100130021'){
//            debug($data);die;
//        }
        //if continuously posted in EHA/HA, EHA, HA & completed 5 years & more but less than 6 years. 	
        if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            if ($data['no_of_months_in_current_unit'] >= 60 && $data['no_of_months_in_current_unit'] < 72) {
                $options = ['rule_number' => '4'];
                $points = CommonLists::getPointsTable($options, $data['regimental_number'], 1);
            }
        }
        return $points;
    }

    public static function getRule5($data) {
        $points = 0;
        //if continuously posted in EHA/HA, EHA, HA & completed 6 years & more tenure. 	
        if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            if ($data['no_of_months_in_current_unit'] >= 72) {
                $options = ['rule_number' => '5'];
                $points = CommonLists::getPointsTable($options, $data['regimental_number'], 1);
            }
        }
        return $points;
    }

    public static function getRule6($data) {
        $points = 0;
        //For each completed month of EHA service. 	
        if (!empty($data['period_of_total_service_rendered_in_eha'])) {
            $options = ['rule_number' => '6'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'], $data['period_of_total_service_rendered_in_eha']);
        }
        return $points;
    }

    public static function getRule7($data) {
        $points = 0;
        //For each completed month of HA service. 	
        if (!empty($data['period_of_total_service_rendered_in_ha'])) {

            $options = ['rule_number' => '7'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'], $data['period_of_total_service_rendered_in_ha']);
        }
        return $points;
    }

    public static function getRule8($data) {
        $points = 0;
        //For each completed month of HA service. 	
        if (!empty($data['period_of_total_service_rendered_in_sa'])) {

            $options = ['rule_number' => '8'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'], $data['period_of_total_service_rendered_in_sa']);
        }
        return $points;
    }

}
