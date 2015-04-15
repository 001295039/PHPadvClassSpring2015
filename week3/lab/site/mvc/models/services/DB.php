<?php

/*
 * Copyright (c) 2013, Gabriel N Forti
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Description of DB
 *
 * @author GForti
 */

namespace App\models\services;
use App\models\interfaces\ILogging;
use \PDO;
use App\models\interfaces\IService;

class DB implements IService {
    
    protected $db = null;
    private $dbConfig = array();
    private $log = null;

    public function __construct($dbConfig, ILogging $log) {
        $this->setDbConfig($dbConfig);      
        $this->setLog($log);
    }
    
    private function getDbConfig() {
        return $this->dbConfig;
    }

    private function setDbConfig($dbConfig) {
        $this->dbConfig = $dbConfig;
    }
    
    private function getLog() {
        return $this->log;
    }

    private function setLog($log) {
        if ( $log instanceof ILogging) {
            $this->log = $log;
        }
        
    }

            
    public function getDB() { 
        if ( null != $this->db ) {
            return $this->db;
        }
        try {
            $config = $this->getDbConfig();
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
          $this->getLog()->log($ex->getMessage());
           $this->closeDB();
        }
        return $this->db;        
    }
    
     public function closeDB() {        
        $this->db = null;        
    }
    
    
}
