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
            //set isAuthorized
            $CI->session->set_userdata(array('isAuthorized' => TRUE));
            
            //Detach the objects and put them in session
            //First get startUnit from settings
            $userStartUnit = $login_user->getUserSetting()->getStartUnit();
            $CI->doctrine->em->detach($userStartUnit);
            $CI->session->set_userdata(array('unit' => $userStartUnit));
            
            $CI->doctrine->em->detach($login_user);
            $CI->session->set_userdata(array('user' => $login_user));
                       
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    
    /**
     * returns a entity with the active user
     * 
     * @return obj
     */
    public function getSessionUser(){
        //ladda resurser
        $CI =& get_instance();
        $sessionUser = $CI->session->userdata('user');
        $sessionUser = $CI->doctrine->em->merge($sessionUser);
        
        return $sessionUser;
    }

    /**
     * returns a entity with the active unit
     * 
     * @return obj
     */
    public function getSessionUnit(){
        //ladda resurser
        $CI =& get_instance();
        $sessionUnit = $CI->session->userdata('unit');
        $sessionUnit = $CI->doctrine->em->merge($sessionUnit);
        
        return $sessionUnit;  
    }

        /**
     * Checks if user is authorized and returns true or false
     * 
     * @return boolean
     */
    public function isAuthorized(){
        //ladda resurser
        $CI =& get_instance();
        $CI->load->database();
        
        if($CI->session->userdata('isAuthorized') == TRUE)
            {return true;}
        else{return false;}
    }
    
}