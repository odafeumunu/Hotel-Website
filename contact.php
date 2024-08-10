<?php
// Database connection details
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $database = "your_database";

// Create connection
$conn = new mysqli("localhost", "root", "", "alarco");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $enterName = $_POST['enterName'];
    $enterEmail = $_POST['enterEmail'];
    $entPhone = $_POST['entPhone'];
    $entMessage = $_POST['entMessage'];

    // Prepare SQL statement
    $sql = "INSERT INTO contact_list (enter_name, email_address, phone_number, enter_message)
            VALUES ('$enterName', '$enterEmail', '$entPhone', '$entMessage')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<p style='text-align: center;font-family: sans-serif;font-weight: 500;font-size: 1.5rem;margin-top: 60px;'>Your message is well received<br><br> We look forward to welcoming you to our hotel. <br><br> <a href='contact.html'>Back</a></p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
