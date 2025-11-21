<?php
// src/views/layouts/head.php
use App\Config\Config;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Admin Panel' ?></title>
    <link rel="stylesheet" href="<?= Config::BASE_URL ?>css/admin.css">
</head>
<body>
    <div class="admin-container">