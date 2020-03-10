<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use App\Oad\Commons\Utils\TokenGenerator;
use Cake\I18n\Time;

class ExportXlsComponent extends Component {

    function allVacancyEntryXls($fileName, $headerRow, $vacanciesDataList) {
     //  die;
        ini_set('max_execution_time', 16000); //increase max_execution_time to 10 min if data set is very large
        $txt_file = fopen('php://output', 'w');

        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-type:application/vmd.ms-excel");
        header("Content-type:application/force-download");
        header("Content-type:application/download");

        header('Content-Disposition: attachment; filename=' . $fileName);
        $fileContent = implode("\t ", $headerRow) . "\n";
        fwrite($txt_file, $fileContent);
        $i = 1;
        $exportData = array();
//        debug($vacanciesDataList); die;
            foreach ($vacanciesDataList as $vacancy) {

                $exportData['sl_no'] = $i;
//                debug($vacancy);die;
                
//                    $exportData['rank_description'] = $vacancy->ms_ranks['description'];
//                    $exportData['cadre_description'] = $vacancy->ms_cadres['description'];
//                    $exportData['unit_description'] = $vacancy->ms_units['description'];
//                    $exportData['sanctioned_post'] = $vacancy->vacancies['sanctioned_post'];
//                    $exportData['posted'] = $vacancy->vacancies['posted'];
//                    $exportData['vacancy'] = $vacancy->vacancies['vacancy'];
                
                if (!empty($vacancy->vacancies['id'])) {
                    $exportData['id'] = $vacancy->vacancies['id'];
                } else {
                    $exportData['id'] = 0;
                }
                
                if (!empty($vacancy->ms_ranks['description'])) {
                    $exportData['rank_description'] = $vacancy->ms_ranks['description'];
                } else {
                    $exportData['rank_description'] = '';
                }
                
                if (!empty($vacancy->ms_cadres['description'])) {
                    $exportData['cadre_description'] = $vacancy->ms_cadres['description'];
                } else {
                    $exportData['cadre_description'] = '';
                }
                
                if (!empty($vacancy->ms_units['description'])) {
                    $exportData['unit_description'] = $vacancy->ms_units['description'];
                } else {
                    $exportData['unit_description'] = '';
                }
                
                if (!empty($vacancy->vacancies['sanctioned_post'])) {
                    $exportData['sanctioned_post'] = $vacancy->vacancies['sanctioned_post'];
                } else {
                    $exportData['sanctioned_post'] = 0;
                }
                
                if (!empty($vacancy->vacancies['posted'])) {
                    $exportData['posted'] = $vacancy->vacancies['posted'];
                } else {
                    $exportData['posted'] = 0;
                }
                
                if (!empty($vacancy->vacancies['vacancy'])) {
                    $exportData['vacancy'] = $vacancy->vacancies['vacancy'];
                } else {
                    $exportData['vacancy'] = 0;
                }
                
                $res = $exportData['sl_no'] . "\t"
                        . $exportData['id'] . "\t"
                        . $exportData['rank_description'] . "\t"
                        . $exportData['cadre_description'] . "\t"
                        . $exportData['unit_description'] . "\t"
                        . $exportData['sanctioned_post'] . "\t"
                        . $exportData['posted'] . "\t"
                        . $exportData['vacancy'] . "\t\n";
                 
                $wrote = fwrite($txt_file, $res);
                $i++;
            }
//            debug($res);
            die;
        fclose($txt_file);
    }
}
