<?php

namespace HelloWorld\Router;


class Router {
    private $uri;
    
    private function filterUri($uri) {
        $uri = str_replace("%20", " ", $uri);
        $uri = trim($uri);
        $len = strlen($uri);
        if($len > 0 && $uri[0] === "/") {
            $uri = substr($uri, 1);
            $len -= 1;
        }
        if($len > 0 && $uri[$len-1] === "/") {
            $uri = substr($uri, 0, $len-1);
        }
        return $uri;
    }
    
    public function route($uri) {
        $uri = $this->filterUri($uri);
        if($uri === "") {
            return [
                "view" => "home"
            ];
        }
        $tokens = explode("/", $uri);
        $nTokens = count($tokens);
        if($nTokens === 1) {
            return [
                "view" => "user",
                "username" => $tokens[0]
            ];
        }
        return [
            "view" => "404"
        ];
    }
}