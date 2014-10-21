<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Auth {

        /**
     * 
     * @param varchar $identificationNr svenskt personnummer
     * @param varchar $password lösenord
     * @return boolean sätter session och userdata om sant
     * 
     */
    public function login($username, $password){
        
        //ladda resurser
        $CI =& get_instance();
        $CI->load->database();
        
        $login_user = $CI->doctrine->em->getRepository('User')->findOneBy(array('identificationNr' => $username, 'password' => sha1($password)));
        
        if($login_user != NULL){
            $CI->session->set_userdata(array('isAuthorized' => TRUE, 'activeUser' => $login_user));
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    public function isAuthorized(){
        //ladda resurser
        $CI =& get_instance();
        $CI->load->database();
        
        if($CI->session->userdata('isAuthorized') == TRUE)
            {return true;}
        else{return false;}
    }
    
}