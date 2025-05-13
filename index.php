<?php
require_once 'controller.php';

ob_start();
require_once 'views/car_form.php';
require_once 'views/car_table.php';
$content = ob_get_clean();

require_once 'views/layout.php';

$editCar = $editCar ?? null;
$editIndex = $editIndex ?? null;
?>