<?php

class Auth {

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password){
        
        //ladda resurser
        $CI =& get_instance();
        $CI->load->database();
        
        $login_user = $CI->doctrine->em->getRepository('Entities\User')->findOneBy(array('identificationNr' => $username, 'password' => sha1($password)));

        if($login_user != NULL){
            $CI->session->set_userdata(array('isAuthorized' => TRUE, 'activeUser' => $login_user));
            return TRUE;
        } else {
            return FALSE;
        }  

    }
    
}