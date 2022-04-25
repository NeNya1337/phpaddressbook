<?php
        class Page {
            private $html, $templates_dir = "src/templates/", $database;

            /**
             * @return Database
             */
            public function getDatabase(): Database { return $this->database;}

            /**
             * @param Database $database
             */
            public function setDatabase(Database $database): void {$this->database = $database; }
            public function load($filename) { return file_get_contents($this->templates_dir.$filename.".html"); }
            public function setHTML($html) { $this->html = $html; }
            public function getHTML() { return $this->html; }
            public function setPlaceholder($placeholder, $content) { $this->setHTML(str_replace($placeholder, $content, $this->getHTML())); }
            public function __construct() {

                $this->database = new Database("phpab");
                $this->setHTML($this->load("main"));


            }
        }