<?php
$conn = new mysqli("localhost", "root", "", "portfolio_hiba");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>