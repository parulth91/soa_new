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

class RulesList {

    //-------------------------------General Cases-----------------------------------------------------------

    public static function getRule1($data) {
        $points = 0;
        if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            //if continuously posted in EHA/HA,EHA,HA & completed more than or equal to 5 years and less than 6 years
            if ($data['no_of_months_completed_continuously'] >= 60 && $data['no_of_months_completed_continuously'] < 72) {
                
                $points = ConstantValues::$rule1;
            }
        }
        return $points;
    }

    public static function getRule2($data) {
        $points = 0;
       if ($data['continuous_ms_unit_category'] == 'EHA/HA' || $data['continuous_ms_unit_category'] == 'EHA' || $data['continuous_ms_unit_category'] == 'HA') {
            //if continuously posted in EHA/HA,EHA,HA & completed more than or equal to 6 years tenure
            if ($data['no_of_months_completed_continuously'] >= 72) {
                $points = $points + ConstantValues::$rule2;
            }
        }

        return $points;
    }

    public static function getRule3($data) {
        $points = 0;

        if ($data['current_unit_category'] == 'HA') {
            if ($data['no_of_months_in_current_unit'] >= '36') {
                $points = $points + ConstantValues::$rule3;
            }
        }

        return $points;
    }

    public static function getRule4($data) {
        $points = 0;
        if ($data['current_unit_category'] == 'EHA') {
            if ($data['no_of_months_in_current_unit'] >= '36') {
                $points = $points + ConstantValues::$rule4;
            }
        }
        return $points;
    }

}
