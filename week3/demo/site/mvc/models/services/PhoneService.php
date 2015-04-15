<?php
/**
 * Description of PhoneService
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;
class PhoneService implements IService {
    
    protected $DAO;
    protected $validator;

    function getValidator() {
        return $this->validator;
    }

    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    function getDAO() {
        return $this->DAO;
    }

    function setDAO(IDAO $DAO) {
        $this->DAO = $DAO;
    }
    
     public function __construct( IDAO $phoneDAO, IService $validator  ) {
        $this->setDAO($phoneTypeDAO);
        $this->setValidator($validator);
    }
    
    
}
