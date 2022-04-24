<?php
        class Page {
            private $html, $templates_dir = "src/templates/";
            private function load($filename) { return file_get_contents($this->templates_dir.$filename.".html"); }
            private function setHTML($html) { $this->html = $html; }
            private function getHTML() { return $this->html; }
            public function __construct() {
                $this->setHTML($this->load("content"));
                echo $this->getHTML();

            }
        }