<?php

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