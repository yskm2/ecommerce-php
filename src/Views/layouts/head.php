<?php
use App\Config\Config;
$page_title = $page_title ?? ($pageTitle ?? 'eBrainrot eCommerce');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tienda en línea de tecnología eBrainrot">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-SOMEHASH" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= Config::BASE_URL ?>css/style.css">
</head>
<body>