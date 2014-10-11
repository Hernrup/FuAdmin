<?php
/**
 * @Ci_session (name="ci_session", indexes={@Index(name="last_activity_idx", columns={"last_activity"})})
 * @Entity
 * 
 */
class Ci_sessions {
    /**
     *
     * @var string 
     * @id
     * @Column (type="string", length=40, nullable=false, options={"default":0})
     */
    protected $session_id;
    
    /**
     *
     * @var string
     * @Column (type="string", length=45, nullable=false, options={"default":0})
     */
    protected $ip_adress;
    
    /**
     *
     * @var string
     * @Column (type="string", length=120, nullable=false) 
     */
    protected $user_agent;
    
    /**
     *
     * @var int
     * @Column (type="integer", length=10, nullable=false, options={"default":0, "unsigned":true})
     */
    protected $last_activity;
    
    /**
     *
     * @var text
     * @Column (type="text", nullable=false)
     */
    protected $user_data;
}