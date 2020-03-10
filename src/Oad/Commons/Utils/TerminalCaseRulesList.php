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

class TerminalCaseRulesList {

    //-------------------------------terminal Cases-----------------------------------------------------------

    public static function getRule1($data) {
        $points = '0';
        $period_of_total_service_rendered_in_ha = $data['period_of_total_service_rendered_in_ha'];
        //$period_of_total_service_rendered_in_sa = $data['period_of_total_service_rendered_in_sa'];
        $period_of_total_service_rendered_in_eha = $data['period_of_total_service_rendered_in_eha'];
        $period_of_total_service_rendered_in_eha_ha = $period_of_total_service_rendered_in_ha + $period_of_total_service_rendered_in_eha;
        if ($period_of_total_service_rendered_in_eha_ha < 180) {
            $options = ['rule_number' => '5'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'])->point;
            //$points = $points + ConstantValues::$rule5;
        }
        return $points;
    }

    public static function getRule2($data) {
        $points = '0';
        $period_of_total_service_rendered_in_ha = $data['period_of_total_service_rendered_in_ha'];
        //$period_of_total_service_rendered_in_sa = $data['period_of_total_service_rendered_in_sa'];
        $period_of_total_service_rendered_in_eha = $data['period_of_total_service_rendered_in_eha'];
        $period_of_total_service_rendered_in_eha_ha = $period_of_total_service_rendered_in_ha + $period_of_total_service_rendered_in_eha;
        if ($period_of_total_service_rendered_in_eha_ha > 180) {
            $options = ['rule_number' => '6'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'])->point;
            //$points = $points + ConstantValues::$rule6;
        }
        return $points;
    }

    public static function getRule3($data) {
        $points = '0';
        $period_of_total_service_rendered_in_ha = $data['period_of_total_service_rendered_in_ha'];
        //$period_of_total_service_rendered_in_sa = $data['period_of_total_service_rendered_in_sa'];
        $period_of_total_service_rendered_in_eha = $data['period_of_total_service_rendered_in_eha'];
        $period_of_total_service_rendered_in_eha_ha = $period_of_total_service_rendered_in_ha + $period_of_total_service_rendered_in_eha;
        if ($period_of_total_service_rendered_in_eha_ha > 240) {
            $options = ['rule_number' => '7'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'])->point;
            //$points = $points + ConstantValues::$rule7;
        }
        return $points;
    }

    public static function getRule4($data) {
        $points = '0';
        $period_of_total_service_rendered_in_ha = $data['period_of_total_service_rendered_in_ha'];
        //$period_of_total_service_rendered_in_sa = $data['period_of_total_service_rendered_in_sa'];
        $period_of_total_service_rendered_in_eha = $data['period_of_total_service_rendered_in_eha'];
        $period_of_total_service_rendered_in_eha_ha = $period_of_total_service_rendered_in_ha + $period_of_total_service_rendered_in_eha;
        if ($period_of_total_service_rendered_in_eha_ha > 300) {
            $options = ['rule_number' => '8'];
            $points = CommonLists::getPointsTable($options, $data['regimental_number'])->point;
            //$points = $points + ConstantValues::$rule8;
        }
        return $points;
    }

}
