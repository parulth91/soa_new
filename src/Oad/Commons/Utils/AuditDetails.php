<?php

/**
 * code is used to implement the audit details to controllers
 */

namespace App\Oad\Commons\Utils;

use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\I18n\Time;

class AuditDetails {

    public $prop1;
    public $b = 1;

    public function setAuditData($userType,$userCode, $clientIp, $loginTimestamp, $loginStatus, $controller, $action, $operationPerformed = null, $status, $logoutTimestamp = null) {
        $url_path = Router::url();
        /*
         * Vinit Verify and change this.
         */
        $actionTime = Time::now();       
        $actionTime->i18nFormat();
        /*
         * end
         */
        $auditDetailsTable = TableRegistry::get('audit_details');
        $auditDetails = $auditDetailsTable->newEntity();
        
        $auditDetails->user_code = $userCode;
        $auditDetails->user_type = $userType;
        $auditDetails->user_ip_address = $clientIp;
        $auditDetails->login_timestamp = $loginTimestamp;
        $auditDetails->login_status = $loginStatus;
        $auditDetails->logout_timestamp = $logoutTimestamp;
       $auditDetails->action_type = $action;
        $auditDetails->module_name = $controller;
        $auditDetails->action_timestamp = $actionTime;
        $auditDetails->url_path = $url_path;
        $auditDetails->operation_performed = $operationPerformed;
        $auditDetails->operation_status = $status;
         
//debug($auditDetails);die;
        if ($auditDetailsTable->save($auditDetails)) {
            $id = $auditDetails->id;
        }
    }

    /*
     * Function to get the employee code if the user id is correct
     */

    public function getUserEmployeeCode($userName) {
        $userEmailId = $userName . '@itbp.gov.in';
        $RoleUserDetailsTable = TableRegistry::get('RoleUserDetails');
        $userDetails = $RoleUserDetailsTable->find('all')->where(['email' => $userEmailId, 'is_active' => true])->toArray();

        $employeeCode = sizeof($userDetails) > 0 ? $userDetails[0]['emp_code'] : null;
        return $employeeCode;
    }
    
    public function getOutsideUserEmployeeCode($userName) {
        $user_Id = $userName;
        $outsideUsersTable = TableRegistry::get('OutsideUsers');
        $outsideUsers = $outsideUsersTable->find('all')->where(['user_id' => $user_Id, 'is_active' => true])->toArray();

        $employeeCode = sizeof($outsideUsers) > 0 ? $outsideUsers[0]['emp_code'] : null;
        return $employeeCode;
    }

    public function get() {
        return $this->prop1;
    }

}
