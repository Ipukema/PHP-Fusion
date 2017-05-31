<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: footer.php
| Author: PHP-Fusion Development Team
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

require_once INCLUDES."footer_includes.php";
\PHPFusion\Panels::getInstance()->getSitePanel();
define("CONTENT", ob_get_clean()); //ob_start() called in header.php
require_once __DIR__.'/cron.php';
if (!isset($fusion_jquery_tags)) {
    $fusion_jquery_tags = '';
}

// Load layout
if (defined('ADMIN_PANEL')) {
    require_once __DIR__.'/admin_layout.php';
} else {
    require_once __DIR__.'/layout.php';
}

// Catch the output
$output = ob_get_contents(); //ob_start() called in maincore
if (ob_get_length() !== FALSE) {
    ob_end_clean();
}

// Do the final output manipulation
$output = handle_output($output);

// Search in output and replace normal links with SEF links
//if (!isset($_GET['aid']) && fusion_get_settings("site_seo") == 1) {
if (!isset($_GET['aid'])) {
    //if (isset($router) && $router->getFilePath() !== "error.php") {
    //  $output = \PHPFusion\Rewrite\Permalinks::getInstance()->getOutput($output);
    //}
    if (fusion_get_settings('site_seo')) {
        \PHPFusion\Rewrite\Permalinks::getPermalinkInstance()->handle_url_routing($output);
        $output = \PHPFusion\Rewrite\Permalinks::getPermalinkInstance()->getOutput($output);
    }
}

if (isset($permalink)) {
    unset($permalink);
}
// Output the final complete page content
echo $output;
remove_notice();

$performance_test = FALSE;
if ($performance_test) {
    $performance_log = \PHPFusion\Database\DatabaseFactory::getConnection('default')->getQueryLog();
    $time = 0;
    foreach ($performance_log as $logs) {
        $current_timed = $logs[0];
        $time = $time + $current_timed;
    }
    print_p($time);
    print_p($performance_log);
}
if ((ob_get_length() > 0)) { // length is a number
    ob_end_flush();
}