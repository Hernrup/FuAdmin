<?php

//default
$SERVER_ARGS = $_SERVER['argv'];

//for CI
$CI_ARGS = [];
array_splice($CI_ARGS, 1, 0, array( $SERVER_ARGS[0]));
$_SERVER['argv'] = $CI_ARGS;

//set  env
$_SERVER['CI_ENV'] = 'testing';

//Load CI
require_once 'public/index.php';

//for testing
$TEST_ARGS = $SERVER_ARGS;
array_splice($TEST_ARGS, 1, 2);
$_SERVER['argv'] = $TEST_ARGS;

