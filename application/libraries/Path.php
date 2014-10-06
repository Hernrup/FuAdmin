<?php
class Path{

	public function __construct()
    {
        
    }

	public function join() {
	    $args = func_get_args();
	    $paths = array();
	    foreach ($args as $arg) {
	        $paths = array_merge($paths, (array)$arg);
	    }

	    $paths = array_map(create_function('$p', 'return trim($p, "/");'), $paths);
	    $paths = array_filter($paths);
	    return join('/', $paths);
	}
}