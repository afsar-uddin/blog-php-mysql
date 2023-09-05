<?php

session_start();

require "../app/core/init.php";

$url = $_GET['url'] ?? 'Home';
$url = strtolower($url);
$url = explode('/', $url);

$page_name = trim($url[0]);
$filename = "../app/pages/".$page_name.'.php';

/** Pagination */
$PGE_NUM = get_pagination_var();

// print_r($page);

if(file_exists($filename)) {
    require_once $filename;
} else {
    require_once "../app/pages/404" . '.php';
}


// echo $url;
// echo "<pre>";
// print_r($url);
// echo "</pre>";

// echo $filename;

// echo "home page";


/**
 * TABLES
 *  users [ id, username, email, password, image, date, role ]
 *  categories [ id, category, slug, disabled ]
 *  posts [ id, user_id, category_id, title, content, image, date, slug ]
 * */