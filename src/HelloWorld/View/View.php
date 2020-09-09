<?php

namespace HelloWorld\View;


class View {
    private $app;
    private $vdir;
    private $vreg;
    private $vsk;
    private $buf;
    private $content;
    private $templateHelper;

    private function addView($key, $vname) {
        if(file_exists($this->vdir . "/" . $this->vreg[$vname])) {
            $this->buf[$key] = [
                "type" => "view",
                "value" => $this->vdir . "/" . $this->vreg[$vname]
            ];
        } else {
            if(!isset($this->buf["hw:err"])) {
                $this->buf["hw:err"] = [
                    "type" => "hw:error",
                    "value" => []
                ];
            }
            $this->buf["hw:err"]["value"][] = [
                "error" => "Summary :: View with name \"$vname\" not found",
                "message" => "Message :: \"" . $this->vdir . "/" . $this->vreg[$vname] . "\" file not found!"
            ];
        }
    }

    public function __construct($app, $vname) {
        $this->app = $app;
        $this->vdir = $app->baseDir() . "/views";
        $this->vreg = require $this->vdir . "/views.php";
        if(isset($this->vreg[$vname])) {
            $this->buf = [];
            $this->vsk = "hw:sv:" . $vname;
            $this->addView($this->vsk, $vname);
        } else {
            $this->content = "" . $vname;
        }
    }

    public function with($key, $value) {
        $this->buf[$key] = [
            "type" => "var",
            "value" => $value
        ];
        return $this;
    }

    public function withView($key, $vname) {
        $this->addView($key, $vname);
        return $this;
    }

    public function templateHelper() {
        if($this->templateHelper === null) {
            $_fullhost = $this->app->fullhost();
            $_view = function($key) use(&$_view, $_fullhost) {
                if(!isset($this->buf[$key])) {
                    return null;
                }
                if($this->buf[$key]["type"] === "view") {
                    include $this->buf[$key]["value"];
                } else if($this->buf[$key]["type"] === "var") {
                    return $this->buf[$key]["value"];
                } else {
                    return $this->buf[$key]["value"];
                }
            };
            $this->templateHelper = $_view;
        }
        return $this->templateHelper;
    }

    public function send() {
        if($this->content !== null) {
            echo $this->content;
        } elseif (isset($this->buf["hw:err"])) {
            $msg = "View errors:";
            $msg .= "<hr>";
            foreach($this->buf["hw:err"]["value"] as $errNo => $err) {
                $msg .= "<div>Error No. :: " . ($errNo + 1) . "</div>";
                $msg .= "<div>" . $err["error"] . "</div>";
                $msg .= "<div>" . $err["message"] . "</div>";
                $msg .= "<hr>";
            }
            echo $msg;
        } else {
            $this->templateHelper()($this->vsk);
        }
        return $this;
    }
}