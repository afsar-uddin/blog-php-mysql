<?php

$url = $_GET['url'] ?? 'Home';
$url = explode('/', $url);

$page_name = trim($url[0]);
$filename = "../app/pages/".$page_name.'.php';

if(file_exists($filename)) {
    require_once $filename;
} else {
    require_once "../app/pages/404" . '.php';
}


// echo $url;
echo "<pre>";
print_r($url);
echo "</pre>";

echo $filename;

// echo "home page";