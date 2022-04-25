<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");
$page = new Page("insert");
$page->setPlaceholder("%METHOD%","insert");
$page->setPlaceholder("%ID%","");
$page->setPlaceholder("%NAME%","");
$page->setPlaceholder("%CITY%","");
echo $page->getHTML();