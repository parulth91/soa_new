<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use App\Oad\Commons\Utils\CommonLists;
use App\Oad\Commons\Utils\RulesList;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $cList;
    public $rList;

    use \Crud\Controller\ControllerTrait;

//    public $components = [
//        'RequestHandler' => [
//            'viewClassMap' => [
//                'xlsx' => 'CakeExcel.Excel',
//            ],
//        ]
//    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('SendEmail');
        $this->loadComponent('ExportXls');
        $this->cList = new CommonLists();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
//        $this->loadComponent('Ajax');
      
        $this->loadComponent('CakeDC/Users.UsersAuth');
        //  $this->loadComponent('DatabaseAuth');
        // $this->loadComponent('RequestHandler', ['enableBeforeRedirect' => false]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
//        $this->viewClass = 'CrudView\View\CrudView';
//    $this->loadComponent('Crud.Crud', [
//        'actions' => [
//            'Crud.Index',
//            'Crud.View',
//            'Crud.Add',
//            'Crud.Edit',
//            'Crud.Delete',
//            'Crud.Lookup',
//        ],
//        'listeners' => [
//            'CrudView.View',
//            'Crud.Redirect',
//            'Crud.RelatedModels',
//            //'CrudView.Search',
//            'Crud.Api',
//            'Crud.ApiQueryLog',
//        ]
//    ]);
//    $this->loadComponent('Search.Prg', [
//        'actions' => ['index']
//    ]);
      public $components = array(
    'DebugKit.Toolbar'
);  
    }
    public function exportInExcel($fileName, $headerRow, $data)
    {
        header('Content-type: application/ms-excel'); /// you can set csv format
        header('Content-Disposition: attachment; filename='.$fileName);
        ini_set('max_execution_time', 1600); //increase max_execution_time to 10 min if data set is very large
        $fileContent = implode("\t ", $headerRow)."\n";
        foreach($data as $result) {
            $fileContent .=  implode("\t ", $result)."\n";
        }
        ob_end_clean();
        echo $fileContent;
        exit;
    }
    public function json($data) {
        $this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }

}
