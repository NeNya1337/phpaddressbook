<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");
$page = new Page("insert");

echo $page->getHTML();