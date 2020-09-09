<?php

use PHPUnit\Framework\TestCase;

use HelloWorld\App;


class AppTest extends TestCase {
    public function testBaseDir() {
        $app = new App("base_dir");
        $this->assertEquals("base_dir", $app->baseDir());
    }

    public function testFullhost() {
        $app = new App("base_dir");
        $this->assertEquals("http://localhost:8000", $app->fullhost());
    }
}