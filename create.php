<?php

/**
 * This is the create page.
 *
 * It shows a form to fill in the data for the new record.
 *
 * @author Mark Lösche
 */
require_once("lib/classes/db.inc.php");
require_once("lib/classes/page.inc.php");
$page = new Page("insert");
$page->setPlaceholder("%METHOD%","insert");
$page->setPlaceholder("%ID%","");
$page->setPlaceholder("%NAME%","");
$page->setPlaceholder("%CITY%","");
echo $page->getHTML();