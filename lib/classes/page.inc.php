<?php

/**
 * This is the page class.
 *
 * It loads the basic page structure and loads the HTML templates.
 *
 * @author Mark Lösche
 */
class Page {
    /**
     * @var string
     */
    private string $html;

    /**
     * @var string
     */
    private string $templates_dir = "lib/templates/";

    /**
     * @var Database
     */
    private Database $database;

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    /**
     * @param Database $database
     */
    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    /**
     * @param $filename
     * @return false|string
     */
    public function load($filename)
    {
        return file_get_contents($this->templates_dir.$filename.".html");
    }

    /**
     * @param $html
     * @return void
     */
    public function setHTML($html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getHTML(): string
    {
        return $this->html;
    }

    /**
     * @param string $placeholder
     * @param string $content
     * @return void
     */
    public function setPlaceholder(string $placeholder, string $content): void
    {
        $this->setHTML(str_replace($placeholder, $content, $this->getHTML()));
    }

    /**
     * @param string $page
     */
    public function __construct(string $page) {

        $this->database = new Database();
        $this->setHTML($this->load("main"));

        $this->setPlaceholder("%HEAD%", $this->load("head"));
        $header = $page == "overview" ? $this->load("header") : "";
        $this->setPlaceholder("%HEADER%", $header);
        $this->setPlaceholder("%CONTENT%", $this->load($page));
        $this->setPlaceholder("%FOOTER%", $this->load("footer"));

    }
}