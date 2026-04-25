<?php
require 'new_atol/config/constants.php';
require 'new_atol/config/database.php';
$db = Database::getInstance();
try {
    $db->query("ALTER TABLE guru ADD COLUMN bidang_studi VARCHAR(100) NULL AFTER email");
    echo "Column added successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
