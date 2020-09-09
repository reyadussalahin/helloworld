<?php

namespace HelloWorld;


use HelloWorld\View\View;


class App {
    private $baseDir;
    private $uri;
    private $fullhost;

    public function __construct($baseDir) {
        $this->baseDir = $baseDir;
        $this->uri = $_SERVER["REQUEST_URI"];
        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") {
            $this->fullhost = "https://" . $_SERVER["HTTP_HOST"];
        } else {
            $this->fullhost = "http://" . $_SERVER["HTTP_HOST"];
        }
    }

    public function baseDir() {
        return $this->baseDir;
    }

    public function fullhost() {
        return $this->fullhost;
    }

    public function processRequest($router) {
        $viewMap = $router->route($this->uri);

        if($viewMap["view"] === "home") {
            return (new View($this, "layouts.app"))
                ->withView("contents", "home");
        }
        if($viewMap["view"] === "user") {
            return (new View($this, "layouts.app"))
                ->withView("contents", "user")
                ->with("username", $viewMap["username"]);
        }
        return new View($this, "error.404");
    }
}