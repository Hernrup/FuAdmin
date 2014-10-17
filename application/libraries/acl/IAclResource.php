<?php
/**
 * Created by PhpStorm.
 * User: mhe
 * Date: 11/10/14
 * Time: 19:13
 */

namespace acl;


interface IAclResource {

    /**
     * @param array $roleCollection
     * @param string $action
     * @return mixed
     */
    public function isAllowed(Array $roleCollection, $action);

    /**
     * @return mixed
     */
    public function getName();
} 