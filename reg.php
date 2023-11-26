<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Perform server-side validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Please fill in all fields.";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match.";
    }

      
        // Hash the password (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL statement to insert into the users table
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration Successful!";
           echo"alert('loggin succesfull')";

        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
else {
    echo "Invalid request method";
}
?>
