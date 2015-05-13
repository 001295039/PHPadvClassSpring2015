<?php

namespace App\models\services;

use App\models\interfaces\IController;
use App\models\interfaces\ILogging;
use Exception;

 final class Index {
     
    
    protected $DI = array();
    protected $log = null;

     
    protected function getLog() {
        return $this->log;
    }

    public function setLog(ILogging $log) {       
        $this->log = $log;
    }
     
     public function addDIController($page, $func) {
         $this->DI[$this->getPageController($page)] = $func;
         return $this;
     }
          /**
         * System config.
         */
        public function __construct() {
            // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
            error_reporting(E_ALL | E_STRICT);
            mb_internal_encoding('UTF-8');
            set_exception_handler(array($this, 'handleException'));
            spl_autoload_register(array($this, 'loadClass'));
            // session
            session_start();
            session_regenerate_id(true);
            
            $this->DI = array();
        }

        /**
         * Run the application!
         */
        public function run(Scope $scope) {  
            $page = $this->getPage();
            if ( !$this->runController($page,$scope) ) {
                throw new PageNotFoundException('Unsafe page "' . $page . '" requested');               
            }          
        }
        
        
        protected function runController($page, Scope $scope) {
                       
            $class_name = $this->getPageController($page);
            $controller = NULL;
            
            if (array_key_exists($class_name,$this->DI)) {                
                $controller = $this->DI[$class_name]();                
            } else { 
                $class_name = "APP\\controller\\$class_name"; 
                if (class_exists($class_name)) {
                    $controller = new $class_name();
                }
            }
            
            if ( $controller instanceof IController ) { 
                return $controller->execute($scope);                   
            }
                        
            return false;
        }
               
        /**
         * Exception handler.
         */
        public function handleException(Exception $ex) {     
            
            if ($ex instanceof PageNotFoundException) {  
                $this->getLog()->logException($ex->getMessage());                
            } else {
                // TODO log exception
               $this->getLog()->logException($ex->getMessage());               
            }
             
             $this->redirect('page404',array("error"=>$ex->getMessage()));
            
        }

        /**
         * Class loader.
         */
        public function loadClass($base) {
            
            $baseName = explode( '\\', $base );
            $className = end( $baseName );     
            
            $folders = array(   "mvc".DIRECTORY_SEPARATOR."controllers",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."dao",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."do",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."interfaces",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."exceptions",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."services"
                            );
            $classFile = FALSE;
            
            foreach($folders as $folder) {
                $classFile = $folder.DIRECTORY_SEPARATOR.$className.'.php';                
                if ( is_dir($folder) &&  file_exists( $classFile ) ) {
                    require_once $classFile;
                    break;
                } 
            }  
             
        }
              

        protected function getPage() {
            $page = filter_input(INPUT_GET, 'page');            
            if ( NULL === $page || $page === FALSE ) {
                $page = 'index';
            }
            return $this->checkPage($page);
        }
        
        protected function getPageController($page) {
            return ucfirst(strtolower($page)).'Controller';
        }

        protected function checkPage($page) {
            if ( !( is_string($page) && preg_match('/^[a-z0-9-]+$/i', $page) != 0 ) ) {
                // TODO log attempt, redirect attacker, ...
               throw new PageNotFoundException('Unsafe page "' . $page . '" requested');
            }                     
            return $page;
        }

    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }

}



       
    //http://php.net/manual/en/language.oop5.typehinting.php
    function runPage() {
        $_configURL = '.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.ini.php';
        $index = new Index();

        /*
         * Functions to use for Dependency Injection
         */
        $_config = new Config($_configURL);
        $_log = new FileLogging();
        $index->setLog($_log);
        $_pdo = new DB($_config->getConfigData('db:dev'), $_log);
        $_scope = new Scope();
        $_scope->util = new Util();
        $_validator = new Validator();
        //http://php.net/manual/en/functions.anonymous.php

         $_EmailTypemodel = new EmailTypeModel();
            $_EmailTypeDAO = new EmailTypeDAO($_pdo->getDB(), $_EmailTypemodel, $_log);
            $_EmailTypeservice = new EmailTypeService($_EmailTypeDAO, $_validator, $_EmailTypemodel);
        
            
             $_Emailmodel = new EmailModel();
            $_EmailDAO = new EmailDAO($_pdo->getDB(), $_Emailmodel, $_log);
            $_Emailservice = new EmailService($_EmailDAO, $_validator, $_Emailmodel, $_EmailTypeservice);
        
        $index->addDIController('index', function() {            
            return new \APP\controller\IndexController();
        })
        ->addDIController('emailtype', function() use ($_EmailTypeservice ) {
         
            return new \APP\controller\EmailtypeController( $_EmailTypeservice);
        });
        $index->addDIController('email', function(){
             return new \APP\controller\IndexController();
        })
        ->addDIController('email', function() use ($_Emailservice ) {
           
            return new \APP\controller\EmailController($_Emailservice);
        });
        
        // run application!
        $index->run($_scope);
    }
    
    runPage();
    