<?php
include 'includes/db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO messages (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $phone, $subject, $message);
    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error sending message.'); window.location.href='index.php';</script>";
    }
    $stmt->close();
}
?>