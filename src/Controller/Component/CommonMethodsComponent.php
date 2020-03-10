<?php

//cod is used to implement the eMail

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
//use Cake\Network\Email\Email;

class CommonMethodsComponent extends Component {

    public function getAllRanks() {
        $ranksTable = TableRegistry::get('MsRanks');
        $msRanks = $ranksTable->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['is_active' => true])->order('description');
        return $msRanks;
    }

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
    public function ajaxGetRankCadre() {
        $ms_rank_id = $_GET['ms_rank_id'];
        $MsCadresTable = TableRegistry::get('CadreRanks');
        $msCadresList = $MsCadresTable
                        ->find('list', ['keyField' => 'ms_cadre_id', 'valueField' => 'MsCadres.description'])
                        ->contain(['msCadres'])
                        ->where(['ms_rank_id' => $ms_rank_id, 'msCadres.is_active' => true])->order('description');
        $ListArr = '';
        $ListArr .= '<option value="">----Select----</option>';
        if (!empty($msCadresList) && isset($msCadresList)) {
            foreach ($msCadresList as $key => $value) {
                $ListArr .= '<option value="' . $key . '">' . $value . '</option>';
            }
        } else {
            $ListArr = 0;
        }
        echo $ListArr;
        exit;
    }

    public function ajaxJebData() {
        $ms_rank_id = $_GET['ms_rank_id'];
        $ms_cadre_id = $_GET['ms_cadre_id'];
        $EmployeeInformationsTable = TableRegistry::get('EmployeeInformations');
        $EmployeeInformationsList = $EmployeeInformationsTable
                        ->find('list', ['keyField' => 'ms_cadre_id', 'valueField' => 'MsCadres.description'])
                        ->contain(['msCadres'])
                        ->where(['EmployeeInformations.ms_rank_id' => $ms_rank_id,
                            'EmployeeInformations.ms_cadre_id' => $ms_cadre_id,
                            'EmployeeInformations.is_active' => true])->order('description');
        echo debug($EmployeeInformationsList->toArray());
        $ListArr = '';
        $ListArr .= '<option value="">----Select----</option>';
        if (!empty($EmployeeInformationsList) && isset($EmployeeInformationsList)) {
            foreach ($EmployeeInformationsList as $key => $value) {
                $ListArr .= '<option value="' . $key . '">' . $value . '</option>';
            }
        } else {
            $ListArr = 0;
        }
        echo $ListArr;
        exit;
    }

}
