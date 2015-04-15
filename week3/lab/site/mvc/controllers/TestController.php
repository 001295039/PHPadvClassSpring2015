<?php

/**
 * Description of TestController
 *
 * @author GFORTI
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;



class TestController extends BaseController implements IController {
    
    
      public function execute(IService $scope) {
          
          $this->data['test1'] = 'hello';
          $this->data['test2'] = 'world';
          
          $scope->view = $this->data;
          $page = 'test';
          return $this->view($page, $scope);          
      }
    
}
