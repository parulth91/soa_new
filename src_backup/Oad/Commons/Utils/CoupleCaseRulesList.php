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

class CoupleCaseRulesList {

    //-------------------------------couple Cases-----------------------------------------------------------


    public static function getRule1($data) {
        $points = 0;
        if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            //if couple case & continuously posted in EHA/HA,EHA,HA & completed more than or equal to 5 years
            if ($data['no_of_months_completed_continuously'] >= 60) {
                $options = ['rule_number' => '10'];
                $points = CommonLists::getPointsTable($options, $data['regimental_number'])->point;
                //$points = $points + ConstantValues::$rule10;
            }
        }
        return $points;
    }

    public static function getRule2($data) {
        $points = 0;

        return $points;
    }

    public static function getRule3($data) {
        $points = 0;

        return $points;
    }

    public static function getRule4($data) {
        $points = 0;

        return $points;
    }

}
