<?php

namespace Entities;

/**
 * @Ci_session (name="ci_session", indexes={@Index(name="last_activity_idx", columns={"last_activity"})})
 * @Entity
 * 
 */
class Ci_sessions extends CoreEntity{
    /**
     *
     * @var string 
     * @id
     * @Column (type="string", length=40, nullable=false, options={"default":0})
     */
    protected $id;
    
    /**
     *
     * @var string
     * @Column (name="ip_address",type="string", length=45, nullable=false, options={"default":0})
     */
    protected $ip_address;
       
    /**
     *
     * @var int
     * @Column (type="integer", length=10, nullable=false, options={"default":0, "unsigned":true})
     */
    protected $timestamp;
    
    /**
     *
     * @var text
     * @Column (type="text", nullable=false)
     */
    protected $data;
}