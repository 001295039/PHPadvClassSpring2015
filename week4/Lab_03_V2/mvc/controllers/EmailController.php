<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of PhonetypeController
 */
namespace APP\controller;
use App\models\interfaces\IController;
use App\models\services\Scope;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;
class EmailController extends BaseController implements IController {
       
    public function __construct( IService $EmailService ) {                
        $this->service = $EmailService;     
       $this->data['model'] = $this->service->getNewEmailModel();
    }
    public function execute(Scope $scope) {
                
        $this->data['model']->reset();
        $viewPage = 'email';
        //var_dump($scope->util->getAction());
        if ( $scope->util->isPostRequest() ) {
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
              
            }
            
            if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('emailid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('emailid'));
            }
                       
        }
        $this->data['Emails'] = $this->service->getAllRows();        
        $this->data['EmailTypes'] = $this->service->getAllEmailTypes();        
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }  
}