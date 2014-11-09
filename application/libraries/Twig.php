<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Twig
{
	private $CI;
	private $_twig;
	private $_template_dir;
	private $_cache_dir;
        private $displayData;

	/**
	 * Constructor
	 *
	 */
	function __construct($debug = false)
	{
		$this->CI =& get_instance();
		$this->CI->config->load('twig');
                
				
		log_message('debug', "Twig Autoloader Loaded");

		Twig_Autoloader::register();

		
		//HMVC patch by joseayram
		// Modular Separation / Modular Extensions has been detected
		$this->_template_dir = array($this->CI->config->item('template_dir'));

		if (method_exists( $this->CI->router, 'fetch_module' ))
		{
		    $this->_module  = $this->CI->router->fetch_module();
		    //add the current module view folder as a template directory
		    if ($this->_module !== '')
				array_push($this->_template_dir, APPPATH.'modules/'.$this->CI->router->fetch_module().'/views/');
		}
		//end HMVC patch 

		
		$this->_cache_dir = $this->CI->config->item('cache_dir');

		$loader = new Twig_Loader_Filesystem($this->_template_dir);

		$this->_twig = new Twig_Environment($loader, array(
                'cache' => $this->_cache_dir,
                'debug' => $debug,
		));

		$this->_twig->addExtension(new Twig_Extension_Debug());
		
        foreach(get_defined_functions() as $functions) {
        		foreach($functions as $function) {
            		$this->_twig->addFunction($function, new Twig_Function_Function($function));
        		}
    	}

            // add globals on twig template
            $this->_twig->addGlobal("session", $this->CI->session);
            $this->_twig->addGlobal("base_url", base_url());
	}

	public function add_function($name) 
	{
		$this->_twig->addFunction($name, new Twig_Function_Function($name));
	}

	public function render($template, $data = array()) 
	{
		$template = $this->_twig->loadTemplate($template);
		return $template->render($data);
	}
        
        public function addData($data){
            //if displayData is null create an array
            if(!is_array($this->displayData)){$this->displayData = array();}
            
            //make input data an array if its not
            $data = is_array($data) ? $data : get_object_vars($data);
            
            //merge the arrays
            $this->displayData = array_merge($this->displayData, $data);
        }

        public function displayRoute($data) 
	{
                $data = is_array($data) ? $data : get_object_vars($data);
                
                if(is_array($this->displayData)){
                    $data = array_merge($this->displayData, $data);
                }
                
		$template = $this->CI->path->join($this->CI->router->fetch_class(),$this->CI->router->fetch_method().".twig");
		$this->display($template, $data);
	}
        

	public function display($template, $data = array()) 
	{
		$template = $this->_twig->loadTemplate($template);
		/* elapsed_time and memory_usage */
		$data['elapsed_time'] = $this->CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');
		$memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2) . 'MB';
		$data['memory_usage'] = $memory;
		$template->display($data);
	}
}