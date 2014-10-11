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


    function __construct()
    {
        $this->staticResources = [];
        $this->setupStaticPermissions();
    }

    function setupStaticPermissions(){
        $this->addStaticResource($this->newStaticResource()->setName("login")->allow(array("reset_password","auth")));
    }

    function newStaticResource(){
        return new StaticResource();
    }

    function addStaticResource(StaticResource $res){
        $this->staticResources[$res->getName()] = $res;
    }

    public function isAllowed(Array $roleCollection, $resource, $action){
        $resourceObject = null;

        if(is_string($resource)){
           if(!array_key_exists($resource,$this->staticResources)){
              throw new \Exception(sprintf("Resource %s not found", $resource));
           }
            $resourceObject = $this->staticResources[$resource];
        }

        if(is_object($resource)){
            $resourceObject = $resource;
        }

        if($resourceObject === null){
            throw new \Exception(sprintf("Resource %s not found", $resource->getName()));
        }

        echo sprintf("%s %s: ", $resourceObject->getName(), $action);

        return $resourceObject->isAllowed($action);
    }
} 