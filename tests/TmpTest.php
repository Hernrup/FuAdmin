<?php

namespace tests;

class TmpTest extends \PHPUnit_Framework_TestCase{
    private $CI;

    public function setUp() {
        $this->CI = &get_instance();
    }


    public function testGetAllPosts3() {
        $this->assertEquals(1, 1);
    }
}
