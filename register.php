<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';
require_once 'src/UserStorage.php';

$errors = [];

require_once 'controller/register_controller.php';
require_once 'views/register_view.php';