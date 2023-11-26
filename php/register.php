<?php
include "config.php"; 

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['pass']; // Change 'password' to 'pass'
    $email = $_POST['email'];

    $sql = $conn->prepare("INSERT INTO users (username, pass, email) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $username, $password, $email);

    if ($sql->execute()) {
        $response = array("status" => "success", "message" => "User registered successfully!");
        http_response_code(200); // Set HTTP status code to 200 (OK)
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error: " . $conn->error);
        http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
        echo json_encode($response);
    }

    $sql->close();
    $conn->close();
}
?>
