<?php
require 'new_atol/config/constants.php';
require 'new_atol/config/database.php';
$db = Database::getInstance();
$cols = $db->query('SHOW COLUMNS FROM user')->fetchAll(PDO::FETCH_ASSOC);
print_r($cols);
