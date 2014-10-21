<?php
define('APPPATH', dirname(__FILE__) . '/../../application/');
define('BASEPATH', APPPATH . '/../../vendor/ellislab/codeigniter/system');
define('ENVIRONMENT', 'development');

chdir(APPPATH);

require APPPATH . '/../application/libraries/Doctrine.php';
require APPPATH."/../vendor/autoload.php";
