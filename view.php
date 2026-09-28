<?php

include "db.php";

$sql = "SELECT * FROM contacts ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>View Contacts | NovaTech</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="view-page">


<!-- NAVBAR -->

<header class="navbar">

    <div class="logo">
        Nova<span>Tech</span>
    </div>


    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="index.php#about">
            About
        </a>

        <a href="index.php#management">
            Manage Contacts
        </a>

    </nav>


    <a href="add.php" class="nav-btn">
        + Add Contact
    </a>

</header>



<!-- VIEW CONTACTS -->

<section class="view-section">

    <div class="view-heading">

        <div>

            <p class="small-title">
                CONTACT DIRECTORY
            </p>

            <h1>
                Your <span>Contacts</span>
            </h1>

            <p>
                View, edit and delete your saved contacts.
            </p>

        </div>


        <a href="add.php" class="primary-btn">
            + Add Contact
        </a>

    </div>


    <!-- SEARCH -->

    <div class="search-box">

        <span>
            🔍
        </span>

        <input
            type="text"
            id="searchInput"
            placeholder="Search contacts..."
            onkeyup="searchContacts()"
        >

    </div>



    <!-- TABLE -->

    <div class="table-container">

        <table id="contactTable">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Address</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

            <?php

            if (mysqli_num_rows($result) > 0) {

                $count = 1;

                while ($row = mysqli_fetch_assoc($result)) {

            ?>

                <tr>

                    <td>
                        <?php echo $count++; ?>
                    </td>


                    <td>

                        <div class="contact-name">

                            <div class="avatar">

                                <?php

                                echo strtoupper(
                                    substr($row["name"], 0, 1)
                                );

                                ?>

                            </div>

                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $row["name"]
                                );
                                ?>
                            </strong>

                        </div>

                    </td>


                    <td>
                        <?php
                        echo htmlspecialchars(
                            $row["email"]
                        );
                        ?>
                    </td>


                    <td>
                        <?php
                        echo htmlspecialchars(
                            $row["phone"]
                        );
                        ?>
                    </td>


                    <td>
                        <?php
                        echo htmlspecialchars(
                            $row["address"]
                        );
                        ?>
                    </td>


                    <td>

                        <div class="actions">

                            <a
                                href="edit.php?id=<?php echo $row["id"]; ?>"
                                class="edit-btn"
                            >
                                ✎ Edit
                            </a>


                            <a
                                href="delete.php?id=<?php echo $row["id"]; ?>"
                                class="delete-btn"
                                onclick="return confirmDelete();"
                            >
                                🗑 Delete
                            </a>

                        </div>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                👥
                            </div>

                            <h3>
                                No Contacts Found
                            </h3>

                            <p>
                                Add your first contact to get started.
                            </p>

                            <a
                                href="add.php"
                                class="primary-btn"
                            >
                                + Add Contact
                            </a>

                        </div>

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>


    <div class="back-home">

        <a href="index.php">
            ← Back to Home
        </a>

    </div>

</section>


<footer>

    <div class="copyright">

        © 2026 NovaTech Contact Management System

    </div>

</footer>


<script src="script.js"></script>

</body>

</html>