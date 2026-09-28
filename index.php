<?php

include "db.php";

$sql = "SELECT * FROM contacts ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$total_contacts = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NovaTech | Contact Management</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>


<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <div class="logo">
        Nova<span>Tech</span>
    </div>

    <nav>

        <a href="#home" class="active">
            Home
        </a>

        <a href="#about">
            About
        </a>

        <a href="#management">
            Manage Contacts
        </a>

    </nav>

    <a href="add.php" class="nav-btn">
        + Add Contact
    </a>

</header>



<!-- ================= HOME ================= -->

<section class="hero" id="home">

    <div class="hero-content">

        <p class="small-title">
            CONTACT MANAGEMENT SYSTEM
        </p>

        <h1>
            Organize Your
            <span>Contacts</span>
            Easily
        </h1>

        <p class="hero-text">

            Keep all your important contact information
            organized in one simple and convenient place.
            Add, view, edit and manage your contacts effortlessly.

        </p>


        <div class="hero-buttons">

            <a href="#management" class="primary-btn">
                Manage Contacts
            </a>

            <a href="#about" class="secondary-btn">
                Learn More
            </a>

        </div>

    </div>


    <div class="hero-visual">

        <div class="hero-card">

            <div class="circle circle-one"></div>

            <div class="circle circle-two"></div>


            <div class="contact-preview">

                <div class="preview-avatar">
                    N
                </div>

                <div>

                    <h3>
                        Contact Manager
                    </h3>

                    <p>
                        Everything organized
                    </p>

                </div>

            </div>


            <div class="floating-card floating-one">
                ✓ Easy Management
            </div>


            <div class="floating-card floating-two">
                + Add Contacts
            </div>

        </div>

    </div>

</section>



<!-- ================= ABOUT ================= -->

<section class="about" id="about">

    <div class="about-heading">

        <p class="small-title">
            ABOUT THE SYSTEM
        </p>

        <h2>
            A simpler way to
            <span>manage contacts.</span>
        </h2>

        <p>

            NovaTech Contact Manager is a simple web-based
            application designed to store and manage contact
            information efficiently.

        </p>

    </div>


    <div class="about-content">

        <div class="about-text">

            <h3>
                Keep your contacts organized
            </h3>

            <p>

                Managing contact information becomes easier
                when everything is available in one place.
                This application allows users to store contact
                details and perform common management operations
                through a simple interface.

            </p>

            <p>

                Users can add new contacts, view existing
                contacts, update incorrect information and
                remove contacts that are no longer required.

            </p>

        </div>


        <div class="about-features">

            <div class="feature-item">

                <div class="feature-icon">
                    ✓
                </div>

                <div>

                    <h4>
                        Easy to Use
                    </h4>

                    <p>
                        Simple and user-friendly interface.
                    </p>

                </div>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    🔒
                </div>

                <div>

                    <h4>
                        Organized Data
                    </h4>

                    <p>
                        Contact information stored systematically.
                    </p>

                </div>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    ⚡
                </div>

                <div>

                    <h4>
                        Quick Management
                    </h4>

                    <p>
                        Add, edit and delete contacts easily.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="technology-box">

        <span>HTML</span>
        <span>CSS</span>
        <span>JavaScript</span>
        <span>PHP</span>
        <span>MySQL</span>

    </div>

</section>



<!-- ================= MANAGEMENT ================= -->

<section class="management" id="management">

    <div class="management-heading">

        <p class="small-title">
            CONTACT MANAGEMENT
        </p>

        <h2>
            Manage Your
            <span>Contacts</span>
        </h2>

        <p>

            Choose an action below to manage your
            contact information.

        </p>

    </div>


    <div class="management-grid">


        <!-- ADD -->

        <a href="add.php" class="management-card">

            <div class="management-icon">
                +
            </div>

            <h3>
                Add Contact
            </h3>

            <p>

                Create a new contact by entering
                their name, email, phone and address.

            </p>

            <span class="card-link">
                Add Contact →
            </span>

        </a>



        <!-- VIEW -->

        <a href="view.php" class="management-card">

            <div class="management-icon">
                👁
            </div>

            <h3>
                View Contacts
            </h3>

            <p>

                View all your saved contacts
                in a clear and organized list.

            </p>

            <span class="card-link">
                View Contacts →
            </span>

        </a>



        <!-- EDIT -->

        <a href="view.php" class="management-card">

            <div class="management-icon">
                ✎
            </div>

            <h3>
                Edit Contact
            </h3>

            <p>

                Update contact information whenever
                the details need to be changed.

            </p>

            <span class="card-link">
                Edit Contacts →
            </span>

        </a>



        <!-- DELETE -->

        <a href="view.php" class="management-card">

            <div class="management-icon delete-icon">
                🗑
            </div>

            <h3>
                Delete Contact
            </h3>

            <p>

                Remove outdated or unnecessary
                contacts from your contact list.

            </p>

            <span class="card-link delete-link">
                Delete Contacts →
            </span>

        </a>


    </div>


    <!-- CONTACT COUNT -->

    <div class="contact-count">

        <div class="count-number">
            <?php echo $total_contacts; ?>
        </div>

        <div>

            <strong>
                Contacts Currently Stored
            </strong>

            <p>
                All contact information is managed through MySQL.
            </p>

        </div>

    </div>

</section>



<!-- ================= FOOTER ================= -->

<footer>

    <div class="footer-content">

        <div>

            <div class="logo">
                Nova<span>Tech</span>
            </div>

            <p>
                Simple and organized contact management.
            </p>

        </div>


        <div class="footer-links">

            <a href="#home">
                Home
            </a>

            <a href="#about">
                About
            </a>

            <a href="#management">
                Manage Contacts
            </a>

        </div>

    </div>


    <div class="copyright">

        © 2026 NovaTech Contact Management System

    </div>

</footer>


<script src="script.js"></script>

</body>

</html>