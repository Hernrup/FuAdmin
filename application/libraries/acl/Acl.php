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
        $this->staticResources = [];
        $this->setupStaticPermissions();
    }

    /**
     *
     */
    protected function setupStaticPermissions(){
        $this->addStaticResource($this->newStaticResource()
            ->setName("login")
            ->allow("reset_password")
            ->allow("auth")
        );
    }

    /**
     * @return StaticResource
     */
    protected function newStaticResource(){
        return new StaticResource();
    }

    /**
     * @param StaticResource $res
     */
    protected function addStaticResource(StaticResource $res){
        $this->staticResources[$res->getName()] = $res;
    }

    /**
     * @param $resource
     * @return mixed
     */
    protected function findStaticResource($resource){

        if(array_key_exists($resource,$this->staticResources)){
            return $this->staticResources[$resource];
        }
    }

    /**
     * @param array $roleCollection
     * @param $resource
     * @param $action
     * @return mixed
     * @throws \Exception
     */
    public function isAllowed(Array $roleCollection, $resource, $action){
        $resourceObject = null;

        if(is_string($resource)){
            $resourceObject = $this->findStaticResource($resource);
            if($resourceObject === null){
                throw new \Exception(sprintf("Resource %s not found", $resource->getName()));
            }
        }

        if(is_object($resource)){
            if(!($resource instanceof iAclResource)){
                throw new \Exception(sprintf("ResourceObject has to be instance of iAclResource"));
            }
            $resourceObject = $resource;
        }

        if($resourceObject === null){
            throw new \Exception(sprintf("Could not evaluate resource"));
        }

        return $resourceObject->isAllowed($action);
    }
} 