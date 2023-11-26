<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform form validation and sanitize input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Perform database connection and retrieval (replace with your actual database details)
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location: profile.php?username=" . $username); // Redirect to profile page after successful login
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Username not found";
    }

    $sql->close();
    $conn->close();
}
?>
