<?php
        class Page {
            private $html, $templates_dir = "src/templates/", $database;
            private function load($filename) { return file_get_contents($this->templates_dir.$filename.".html"); }
            private function setHTML($html) { $this->html = $html; }
            private function getHTML() { return $this->html; }
            private function setPlaceholder($placeholder, $content) { $this->setHTML(str_replace($placeholder, $content, $this->getHTML())); }
            public function __construct() {

                $this->database = new Database("phpab");
                $this->setHTML($this->load("main"));
                $this->setPlaceholder("%HEAD%", $this->load("head"));
                $this->setPlaceholder("%HEADER%", $this->load("header"));
                $this->setPlaceholder("%CONTENT%", $this->load("content"));
                $this->setPlaceholder("%TABLE%", $this->load("table"));
                $this->setPlaceholder("%ROW%", $this->load("row"));
                $this->setPlaceholder("%FOOTER%", $this->load("footer"));
                echo $this->getHTML();

            }
        }