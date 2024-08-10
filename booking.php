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



// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
      rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <title>BOOKINGS || ALARCO HOTELS AND SUITES</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/favicon.png" />

    <!-- swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomAvailability = <?= json_encode($roomAvailability); ?>;
            const roomTypeSelect = document.getElementById('roomType');
            const roomNumberSelect = document.getElementById('roomNumber');

            roomTypeSelect.addEventListener('change', function() {
                const selectedRoomType = this.value;
                const selectedRoom = roomAvailability.find(room => room.room_type === selectedRoomType);
                const maxRoomsAvailable = selectedRoom ? selectedRoom.total_rooms - selectedRoom.booked_rooms : 0;

                for (let i = 0; i < roomNumberSelect.options.length; i++) {
                    const option = roomNumberSelect.options[i];
                    option.disabled = parseInt(option.value) > maxRoomsAvailable;
                }
            });

            // Trigger change event to set initial state
            roomTypeSelect.dispatchEvent(new Event('change'));
        });
    </script>
  </head>
  <body>

    <header class="header inner">
      <nav>
        <div class="nav__bar">
          <div class="logo">
            <a href="index.html"><img src="assets/logo.png" alt="logo" /></a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="room.html">Rooms</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="gallery.html">Gallery</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <a href="booking.php">
          <button class="btn nav__btn">Book Now</button>
        </a>
      </nav>
    </header>

    <style>
        form{
            background-color: #fff;
            height: fit-content;
            width: 850px;
            margin: auto;
            margin-top: 80px;
            border-radius: 25px;
            padding: 50px 40px;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
        }
        form h1{
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        form .form-grid{
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 80px;
        }
        form .form-grid-inner{
            position: relative;
        }
        form input, form select{
            width: 100%;
            position: absolute;
            outline: none;
            left: 0;
            right: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px 15px;
            background-color: transparent;
            font-size: 1rem;
            z-index: 50;
        }
        form select{
            position: relative;
        }
        form .labelline{
            position: absolute;
            padding: 0 10px;
            margin: 13px 6px;
            font-size: 0.95rem;
            transition: 0.3s;
            background-color: #fff;
            color: #666;
        }
        form input:focus,
        form select:focus{
            border: 2px solid var(--primary-color);
        }
        form input:focus + .labelline,
        form select:focus + .labelline{
            transform: translateY(-20px);
            font-size: 0.7rem;
            color: var(--primary-color);
            z-index: 51;
        }

        form label{
            font-size: 1rem;
            padding-left: 3px;
        }
        .last{
            display: flex;
            margin-top: 30px;
        }
        .last .btn{
            width: 100%;
            padding: 10px 0;
            text-transform: uppercase;
            font-size: 1rem;
        }
        .bank-area {
            margin-top: 80px;
            margin-bottom: 0;
        }
        .bank img{
            height: 30px;
            width: initial;
            margin-bottom: 10px;
        }
        .bank p {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .bank p span{
            font-weight: 500;
        }


        @media (max-width: 900px){
            form {
                width: 100%;
                box-shadow: none;
            }
        }

        @media (max-width: 768px){
            form .form-grid {
                grid-template-columns: subgrid;
                margin-bottom: 40px;
            }
            form .form-grid-inner{
                margin-top: 40px;
            }
        }

        @media (max-width: 450px){
            form {
                padding: 40px 20px;
            }
        }
    </style>
    

    <section class="section__container room__container ">
        <form action="booking_inner.php" method="POST" enctype="multipart/form-data">
            <h1>RESERVATION</h1>

            <div class="form-grid">
                <div class="form-grid-inner">
                    <input type="text" name="firstName" id="firstName" required>
                    <div class="labelline">First Name</div>
                </div>

                <div class="form-grid-inner">
                    <input type="text" name="lastName" id="lasttName" required>
                    <div class="labelline">Last Name</div>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-grid-inner">
                    <input type="email" name="emailAddress" id="emailAddress" required>
                    <div class="labelline">Email Address</div>
                </div>

                <div class="form-grid-inner">
                    <input type="tel" name="phoneNumber" id="phoneNumber" required>
                    <div class="labelline">Phone Number</div>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-grid-inner">
                    <label for="roomType" style="margin-bottom: 10px; display: block;">Room Type</label>
                    <select name="roomType" id="roomType" required>
                        <option value="" selected disabled hidden></option>
                        <?php foreach ($roomAvailability as $room): 
                            $isDisabled = ($room['total_rooms'] - $room['booked_rooms']) <= 0;
                            $disabledAttribute = $isDisabled ? 'disabled' : '';
                        ?>
                            <option value="<?= htmlspecialchars($room['room_type']); ?>" <?= $disabledAttribute; ?>>
                                <?= htmlspecialchars($room['room_type']); ?> <?= $isDisabled ? '(Fully Booked)' : ''; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-grid-inner" style="margin-top: 0px;">
                    <label for="roomNumber" style="margin-bottom: 10px; display: block;">Number of Rooms</label>
                    <select name="roomNumber" id="roomNumber" required>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-grid" style="margin-top: -40px;">
                <div class="form-grid-inner">
                    <label for="checkInDate">Check In Date</label>
                    <div style="margin-top: 10px;">
                        <input type="date" name="checkInDate" id="checkInDate" required>
                    </div>
                </div>

                <div class="form-grid-inner">
                    <label for="checkOutDate">Check Out Date</label>
                    <div style="margin-top: 10px;">
                        <input type="date" name="checkOutDate" id="checkOutDate" required>
                    </div>
                </div>
            </div>

            <div class="form-grid bank-area" style="margin-bottom: 40px;">
                <div class="bank">
                    <img src="assets/access.png" alt="">
                    <p>Name of Bank: <span>Access Bank</span></p>
                    <p>Account Number: <span>0773942079</span></p>
                    <p>Account Name: <span>Alarco Hotels and Suites</span></p>
                </div>
                <div class="bank">
                    <img src="assets/gmai.png" alt="">
                    <p>Name of Bank: <span>GTBank Plc</span></p>
                    <p>Account Number: <span>0164499253</span></p>
                    <p>Account Name: <span>Alarco Hotels and Suites</span></p>
                </div>
            </div>

            <p class="amount-payable" style="margin-bottom: 15px; font-size: 1rem; font-weight: 500;">
                AMOUNT PAYABLE: <span id="amountSpan" style="font-weight: 600; color: red;"></span>
            </p>

            <p style="margin-bottom: 20px; font-size: 0.85rem; font-weight: 500;">
                <span style="color: red; font-style: italic;">
                    N.B: Price is updated according to your RoomType, Number of Rooms and your Check-in/Check-out dates.
                </span>
                <br><br>
                <span>
                    Kindly transfer the amount payable <span style="color: red; font-style: italic;">(in red)</span> to any of the bank accounts and upload the receipt/screenshot of payment.
                </span>
            </p>

            <div class="form-grid">
                <div class="form-grid-inner">
                    <label for="fileInput">Upload Receipt/Screenshot of Payment</label>
                    <div style="margin-top: 10px;">
                        <input type="file" id="fileInput" name="fileInput" accept=".jpg, .jpeg, .png, .pdf" required>
                        <div class="require" style="position: relative; top: 50px">
                            <span style="font-size: 0.8rem">jpg <sup style="color: red;">*</sup></span>
                            <span style="font-size: 0.8rem">png <sup style="color: red;">*</sup></span>
                            <span style="font-size: 0.8rem">pdf <sup style="color: red;">*</sup></span>
                        </div>
                        <div class="uploa" style="position: relative; top: 60px;">
                            <div id="imagePreview"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-grid-con">
                <div class="form-grid-inner" style="display: flex; align-items: flex-start; margin-top: 70px;">
                    <input type="checkbox" name="consentCheck" id="consentCheck" style="position: relative; margin-right: 7px; width: initial; display: inline-block; margin-top: 5px; transform: scale(1.2);" required>
                    <label for="consentCheck">I consent to hotel policies and terms</label>
                </div>
            </div>

            <div class="last">
                <button type="submit" class="btn">Submit Booking</button>
            </div>
        </form>
    </section>

    

    <footer class="footer" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo">
            <img src="assets/logo.png" alt="logo" />
          </div>
          <p class="section__description">
            Discover a world of comfort, luxury, and adventure as you explore
            our curated selection of hotels, making every moment of your getaway
            truly extraordinary.
          </p>
          <a href="booking.php">
            <button class="btn">Book Now</button>
          </a>
        </div>
        <div class="footer__col">
          <h4>QUICK LINKS</h4>
          <ul class="footer__links">
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="about.html">About us | Who we are</a></li>
            <li><a href="room.html">Rooms and Amenities</a></li>
            <li><a href="services.html">Our Services</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>OUR SERVICES</h4>
          <ul class="footer__links">
            <li><a href="services.html#restaurant">Restaurant</a></li>
            <li><a href="services.html#bar">Bush Bar</a></li>
            <li><a href="services.html#event">Events Hall</a></li>
            <li><a href="services.html#gym">Gym & Fitness</a></li>
            <li><a href="services.html#spa">Pool</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>CONTACT US</h4>
          <ul class="footer__links">
            <li><a href="mailto:alarcosuites@gmail.com">alarcosuites@gmail.com</a></li>
          </ul>
          <div class="footer__socials">
            <a href="https://www.facebook.com/p/Alarco-Hotels-Suites-100069453642676/" target="_blank"><img src="assets/facebook.png" alt="facebook" /></a>
            <a href="https://wa.me/08165431312" target="_blank"><img src="assets/whatsapp.png" alt="whatsapp" /></a>
            <a href="https://www.instagram.com/alarcohotel?igsh=MW9mZG4xNnBiNHptMw==" target="_blank"><img src="assets/instagram.png" alt="instagram" /></a>
          </div>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Alarco Hotels and Suites. All rights reserved.
      </div>
    </footer>

    

    <!-- scroll to top -->
    <div class="to-top">
      <i class="ri-arrow-up-double-line"></i>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        
        // form input and select

        $(document).ready(function () {
        $("form input, form select").focus(function () {
            $(this).siblings(".labelline").css({
            "transform": "translateY(-20px)",
            "font-size": "0.7rem",
            "color": "var(--primary-color)",
            "z-index": "51"
            });
        });
        $("form input, form select").blur(function () {
            if ($(this).val().trim() === "") {
            $(this).siblings(".labelline").css({
                "transform": "translateY(0)",
                "font-size": "0.9rem",
                "color": "#666",
                "z-index": "initial" 
            });
            }
        });
        });



        // Upload File Input

        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("fileInput");
            const imagePreview = document.getElementById("imagePreview");

            fileInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;
                        img.style.maxWidth = "150px";
                        img.style.maxHeight = "150px";
                        img.style.width = "auto"; // Ensures responsiveness
                        imagePreview.innerHTML = "";
                        imagePreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>


<script>
    // Function to calculate the price
    function calculatePrice() {
        // Get the selected room type
        var roomType = document.getElementById("roomType").value;

        // Get the number of rooms
        var roomNumber = parseInt(document.getElementById("roomNumber").value);

        // Get the check-in and check-out dates
        var checkInDate = new Date(document.getElementById("checkInDate").value);
        var checkOutDate = new Date(document.getElementById("checkOutDate").value);

        // Calculate the number of nights
        var numberOfNights = (checkOutDate - checkInDate) / (1000 * 3600 * 24);

        // Calculate the price based on the room type and number of nights
        var price;
        switch (roomType) {
            case "Standard Room ₦20k/night":
                price = 20000 * numberOfNights * roomNumber;
                break;
            case "Executive Room ₦25k/night":
                price = 25000 * numberOfNights * roomNumber;
                break;
            case "Suites ₦30k/night":
                price = 30000 * numberOfNights * roomNumber;
                break;
            case "Dip Suites ₦35k/night":
                price = 35000 * numberOfNights * roomNumber;
                break;
            default:
                price = 0;
                break;
        }

        // Update the amountSpan with the calculated price
        document.getElementById("amountSpan").textContent = "₦" + price.toFixed(2);
    }

    // Event listeners to trigger calculatePrice() when input values change
    document.getElementById("roomType").addEventListener("change", calculatePrice);
    document.getElementById("roomNumber").addEventListener("change", calculatePrice);
    document.getElementById("checkInDate").addEventListener("change", calculatePrice);
    document.getElementById("checkOutDate").addEventListener("change", calculatePrice);

    // Initial call to calculatePrice() to display the default price
    calculatePrice();
</script>


    

    <script src="main.js"></script>


  </body>
</html>
