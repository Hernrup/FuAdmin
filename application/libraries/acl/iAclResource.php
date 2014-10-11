<?php
/**
 * Created by PhpStorm.
 * User: mhe
 * Date: 11/10/14
 * Time: 19:13
 */

namespace acl;


interface iAclResource {

    public function isAllowed($action);
    public function getName();
} 