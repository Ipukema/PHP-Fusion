<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: search_news_include_button.php
| Author: Robert Gaudyn (Wooya)
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
if (db_exists(DB_NEWS)) {
    $form_elements['news']['enabled'] = array("datelimit", "fields1", "fields2", "fields3", "sort", "order1", "order2", "chars");
    $form_elements['news']['disabled'] = array();
    $form_elements['news']['display'] = array();
    $form_elements['news']['nodisplay'] = array();
    $radio_button['news'] = form_checkbox('stype', fusion_get_locale('n400', LOCALE.LOCALESET."search/news.php"), $_GET['stype'],
                               					array(
                                   					'type' 			=> 'radio',
                                   					'value' 		=> 'news',
                                   					'reverse_label' => TRUE,
                               						)
							            		);
}
