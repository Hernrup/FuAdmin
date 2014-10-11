<?php
class Auth {
    
    /**
     * 
     * @param varchar $identificationNr svenskt personnummer
     * @param varchar $password lösenord
     * @return boolean sätter session och userdata om sant
     * 
     */
    public function login($username, $password){
        $login_user = Doctrine::getTable('User')->findOneBy('identificationnr', $identificationNr);
        if($login_user != NULL and $login_user->password == sha1($password)){
            $this->session->set_userdata('isAuthorized', TRUE);
            $this->session->set_userdata($login_user);
            return TRUE;
        } else {
            $this->session->set_userdata('isAuthorized', FALSE);
            return FALSE;
        }  
    }
    
}