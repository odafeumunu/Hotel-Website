# Alarco Hotels and Suites 🏨

A responsive and modern website for Alarco Hotels and Suites, designed to showcase its luxurious accommodations, top-tier services, and provide a seamless booking experience for guests. This project features a complete front-end presentation and a functional PHP backend for handling reservations and contact inquiries.

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## ✨ Features

-   **Stunning UI**: A modern, fully responsive user interface built with HTML, CSS, and JavaScript.
-   **Dynamic Content**: Interactive carousels and galleries to showcase rooms, amenities, and hotel facilities.
-   **Online Reservations**: A complete booking form that allows users to select room types, check-in/out dates, and upload payment receipts.
-   **Backend Processing**: PHP scripts to handle form submissions, validate room availability, and store booking data in a MySQL database.
-   **Contact System**: A functional contact form for user inquiries, which stores messages in the database.
-   **Real-time Availability**: The booking form dynamically checks and disables options for fully booked rooms.

## 🛠️ Technologies Used

| Technology | Description |
| :--- | :--- |
| [HTML5](https://developer.mozilla.org/en-US/docs/Web/HTML) | Core markup language for the website structure. |
| [CSS3](https://developer.mozilla.org/en-US/docs/Web/CSS) | Styling the website for a modern and responsive design. |
| [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)| Used for interactive elements like navigation, carousels, and form validation. |
| [PHP](https://www.php.net/) | Server-side scripting for processing form data and database interaction. |
| [MySQL](https://www.mysql.com/) | Database management system for storing reservations and contact messages. |
| [Swiper.js](https://swiperjs.com/) | For creating touch-enabled and responsive content sliders. |
| [ScrollReveal](https://scrollrevealjs.org/) | To animate elements as they enter the viewport. |

## 🚀 Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

You need a local server environment that supports PHP and MySQL. We recommend using [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/).

### Installation

1.  📥 **Clone the repository**:
    ```bash
    git clone https://github.com/odafeumunu/Hotel-and-suites.git
    ```
2.  📂 **Move to your server directory**:
    -   Move the cloned `Hotel-and-suites` folder into the `htdocs` directory if you are using XAMPP, or the `www` directory for WAMP.

3.  🗄️ **Database Setup**:
    -   Start your Apache and MySQL services from the XAMPP/WAMP control panel.
    -   Open your web browser and navigate to `http://localhost/phpmyadmin/`.
    -   Create a new database named `alarco`.
    -   Select the `alarco` database and go to the `SQL` tab.
    -   Execute the following SQL queries to create the necessary tables:

    ```sql
    -- Table structure for room_availability
    CREATE TABLE `room_availability` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `room_type` varchar(255) NOT NULL,
      `total_rooms` int(11) NOT NULL,
      `booked_rooms` int(11) NOT NULL DEFAULT 0,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- Inserting data for room_availability
    INSERT INTO `room_availability` (`room_type`, `total_rooms`, `booked_rooms`) VALUES
    ('Standard Room ₦20k/night', 10, 0),
    ('Executive Room ₦25k/night', 8, 0),
    ('Suites ₦30k/night', 5, 0),
    ('Dip Suites ₦35k/night', 3, 0);

    -- Table structure for reservations
    CREATE TABLE `reservations` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `first_name` varchar(255) NOT NULL,
      `last_name` varchar(255) NOT NULL,
      `email_address` varchar(255) NOT NULL,
      `phone_number` varchar(20) NOT NULL,
      `check_in_date` date NOT NULL,
      `check_out_date` date NOT NULL,
      `room_type` varchar(255) NOT NULL,
      `room_number` int(11) NOT NULL,
      `file_path` varchar(255) NOT NULL,
      `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- Table structure for contact_list
    CREATE TABLE `contact_list` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `enter_name` varchar(255) NOT NULL,
      `email_address` varchar(255) NOT NULL,
      `phone_number` varchar(20) NOT NULL,
      `enter_message` text NOT NULL,
      `submission_time` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

4.  📁 **Create Uploads Directory**:
    -   Inside the `Hotel-and-suites` project folder, create a new directory named `uploads`. This is where payment receipts will be stored.

5.  🌐 **Run the Application**:
    -   Open your browser and go to `http://localhost/Hotel-and-suites/`.

## 📖 Usage

-   **Homepage**: The landing page provides an overview of the hotel, featured rooms, and services.
-   **Browse Rooms**: Navigate to the "Rooms" page to see detailed information about different room types, including Standard, Executive, Suites, and Dip Suites.
-   **View Services**: The "Services" page details the various amenities offered, such as the restaurant, bush bar, gym, and pool.
-   **Make a Reservation**:
    1.  Click the "Book Now" button or navigate to the booking page.
    2.  Fill in your personal details.
    3.  Select your desired room type, number of rooms, and check-in/check-out dates.
    4.  The "Amount Payable" will be calculated automatically.
    5.  Make a bank transfer to the provided account details.
    6.  Upload a screenshot or PDF of your payment receipt.
    7.  Submit the form to finalize your booking.
-   **Contact Us**: Use the "Contact" page to send messages or find the hotel's location and contact details.

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1.  🍴 Fork the Project
2.  🌿 Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  ✨ Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  🚀 Push to the Branch (`git push origin feature/AmazingFeature`)
5.  🎉 Open a Pull Request

## 📜 License

This project is open-source and available for anyone to use. No specific license is attached.

## ✍️ Author

**Odafe Umunu**

-   **LinkedIn**: (https://www.linkedin.com/in/odafe-umunu/)