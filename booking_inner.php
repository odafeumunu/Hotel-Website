<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "alarco");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8mb4
$conn->set_charset("utf8mb4");

// Fetch room availability data from the database
$roomAvailability = [];
$sql = "SELECT room_type, total_rooms, booked_rooms FROM room_availability";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roomAvailability[] = $row;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $phoneNumber = $_POST['phoneNumber'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $roomType = $_POST['roomType'];
    $roomNumber = $_POST['roomNumber'];

    // Check room availability
    $availabilityCheck = $conn->prepare("SELECT total_rooms, booked_rooms FROM room_availability WHERE room_type = ?");
    $availabilityCheck->bind_param("s", $roomType);
    $availabilityCheck->execute();
    $availabilityCheck->bind_result($totalRooms, $bookedRooms);
    $availabilityCheck->fetch();
    $availabilityCheck->close();

    if ($totalRooms - $bookedRooms >= $roomNumber) {
        // Rooms are available, proceed with booking

        // Define the directory where files will be permanently stored
        $uploadDirectory = 'uploads/';

        // Generate a unique filename to avoid conflicts
        $fileName = uniqid() . '_' . basename($_FILES["fileInput"]["name"]);
        $targetFile = $uploadDirectory . $fileName;

        // Attempt to move the uploaded file to the permanent directory
        if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFile)) {
            // File upload successful, proceed with database insertion

            // Prepare SQL statement
            $sql = "INSERT INTO reservations (first_name, last_name, email_address, phone_number, check_in_date, check_out_date, room_type, room_number, file_path)
                    VALUES ('$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$checkInDate', '$checkOutDate', '$roomType', '$roomNumber', '$targetFile')";

            // Execute SQL statement
            if ($conn->query($sql) === TRUE) {
                // Update room availability
                $updateAvailability = $conn->prepare("UPDATE room_availability SET booked_rooms = booked_rooms + ? WHERE room_type = ?");
                $updateAvailability->bind_param("is", $roomNumber, $roomType);
                $updateAvailability->execute();
                $updateAvailability->close();

                echo "<p style='text-align: center; font-family: sans-serif; font-weight: 500; font-size: 1.5rem; margin-top: 60px;'>
                    Thank you for your booking!<br><br>
                    Your reservation has been successfully submitted.<br><br>
                    We look forward to welcoming you to our hotel.<br><br>
                    <a href='booking.php'>Back</a>
                  </p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, the selected room type is fully booked for the requested number of rooms.";
    }
}

// Close connection
$conn->close();
?>