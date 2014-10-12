<?php
/**
 * Created by PhpStorm.
 * User: mhe
 * Date: 11/10/14
 * Time: 19:13
 */

namespace acl;


interface iAclResource {

    /**
     * @param $action
     * @return mixed
     */
    public function isAllowed($action);

    /**
     * @return mixed
     */
    public function getName();
} 