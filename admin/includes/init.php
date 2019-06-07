<?php

include 'functions.php';
include 'config.php';
include 'database.php';
include 'db_object.php';
include 'user.php';
include 'photo.php';
include 'comment.php';
include 'session.php';
include 'paginate.php';

define('SITE_ROOT', 'C:\xampp\htdocs\udemy');

defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', SITE_ROOT . '/admin/includes');

?>