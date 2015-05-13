<?php
namespace App\models\services;


class EmailModel extends BaseModel {
    
    private $emailid;
    private $email;
    private $active;
     private $emailtypeactive;
    private $emailtypeid;
    private $emailtype;
    private $logged;
    private $lastupdated;
    
    function getEmailtypeactive() {
        return $this->emailtypeactive;
    }

    function setEmailtypeactive($emailtypeactive) {
        $this->emailtypeactive = $emailtypeactive;
    }

        function getEmailid() {
        return $this->emailid;
    }
     function getEmailTypeid() {
        return $this->emailtypeid;
    }
    function getEmailType() {
        return $this->emailtype;
    }
    function getEmail() {
        return $this->email;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

        function setActive($active) {
        $this->active = $active;
    }
    function setLogged($logged) {
        $this->logged = $logged;
    }
    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

}
