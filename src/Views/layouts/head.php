<?php
// src/views/layouts/head.php
use App\Config\Config;
$page_title = $page_title ?? 'eBrainrot eCommerce'; 
?>

<head>
    
    <title><?= isset($page_title) ? $page_title : 'Inicio - eBrainrot' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- agregaremos tofos los css y js que necesitemos -->
    <link rel="stylesheet" href="<?= Config::BASE_URL ?>css/style.css">

    <link rel="stylesheet" href="font-awesome/css/fontawesome.css">
    <link rel="stylesheet" href="font-awesome/css/brands.css">
        
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>