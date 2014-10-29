<?php
/**
 * Created by PhpStorm.
 * User: mhe
 * Date: 11/10/14
 * Time: 19:24
 */


namespace acl;

class Acl {

   protected $staticResources;

    /**
     *
     */
    function __construct()
    {

    }



    public function isAllowed(Array $roleCollection, $resource, $action, $unit){
        $resourceObject = null;

        //
//
//
//isAllowed(res, action, unit){
//roleList = $SESSION.user.rolelist
//foreach(rolelist as role)
//	$aclconfrows ? fetch ACL_conf where role,res,action
//
//foreach(aclconfrows as row)
//	if unit = row.unit
//    true
//
//	else if inherit
//    if unit IN parents
//			return true
//	end foreach;
//end foreach;
//
//}

        return true;
    }
}


