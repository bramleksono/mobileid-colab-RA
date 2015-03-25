<?php

class RAController {
    
    private function compareString($a, $b) {
        if (!is_string($a) || !is_string($b)) { 
            return false; 
        } 
        $len = strlen($a); 
        if ($len !== strlen($b)) { 
            return false; 
        } 
        $status = 0; 
        for ($i = 0; $i < $len; $i++) { 
            $status |= ord($a[$i]) ^ ord($b[$i]); 
        } 
        return $status === 0; 
    }
    
    public function loadUsers() {
        global $userfile;
        
        //Load Address
        $users = json_decode(file_get_contents($userfile));
        $this->users = $users;
    }
    
    public function compareUserPassword($username, $passwd) {
        $this->loadUsers();
        $users = $this->users;
        $result=0;        
        
        foreach ($users->users as $user) {
            $dbuser = $user->user;
            $dbpasswd = $user->passwd;
            
            if ($this->compareString($username,$dbuser)) {
                if ($this->compareString($passwd,$dbpasswd)) {
                    $this->user = $user;
                    $result=1;
                }
                else $result=0;
                
                break;
            }
        }
        
        return $result;
    }
    
    public function startSession($username) {
        $_SESSION["user"] = $this->user->user;
        $_SESSION["name"] = $this->user->name;
    }
    
    public function endSession() {
        // Unset all of the session variables.
        $_SESSION = array();
        header("Location: ./");
    }
}