<?php

include "db.php";


/* =========================
   GET CONTACT ID
========================= */

if (!isset($_GET["id"])) {

    header("Location: view.php");

    exit();

}


$id = intval($_GET["id"]);



/* =========================
   GET CONTACT
========================= */

$sql = "SELECT * FROM contacts WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$contact = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);



if (!$contact) {

    header("Location: view.php");

    exit();

}


$message = "";

$message_type = "";



/* =========================
   UPDATE CONTACT
========================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);

    $email = trim($_POST["email"]);

    $phone = trim($_POST["phone"]);

    $address = trim($_POST["address"]);



    /* =========================
       VALIDATION
    ========================= */

    if (
        $name == "" ||
        $email == "" ||
        $phone == ""
    ) {

        $message =
            "Please fill in all required fields.";

        $message_type = "error";

    }


    elseif (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $message =
            "Please enter a valid email address.";

        $message_type = "error";

    }


    elseif (
        !preg_match(
            "/^[0-9]{10}$/",
            $phone
        )
    ) {

        $message =
            "Mobile number must contain exactly 10 digits.";

        $message_type = "error";

    }


    else {

        /* =========================
           UPDATE DATABASE
        ========================= */

        $sql = "
            UPDATE contacts
            SET
                name = ?,
                email = ?,
                phone = ?,
                address = ?
            WHERE id = ?
        ";


        $stmt = mysqli_prepare(
            $conn,
            $sql
        );


        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ssssi",
                $name,
                $email,
                $phone,
                $address,
                $id
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header(
                    "Location: view.php?success=updated"
                );

                exit();

            }


            else {

                $message =
                    "Unable to update contact.";

                $message_type = "error";

            }


            mysqli_stmt_close($stmt);

        }

        else {

            $message =
                "Database error: "
                . mysqli_error($conn);

            $message_type = "error";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Contact | NovaTech</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body class="form-page">


<!-- ================= NAVBAR ================= -->

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


    <a
        href="view.php"
        class="nav-btn"
    >
        ← Back
    </a>

</header>



<!-- ================= EDIT FORM ================= -->

<section class="form-section">

    <div class="form-card">


        <div class="form-header">

            <div class="large-icon">
                ✎
            </div>


            <p class="small-title">
                CONTACT MANAGEMENT
            </p>


            <h1>
                Edit <span>Contact</span>
            </h1>


            <p>
                Update the contact information.
            </p>

        </div>



        <!-- MESSAGE -->

        <?php if ($message != "") { ?>

            <div class="<?php echo $message_type; ?>">

                <?php
                    echo htmlspecialchars($message);
                ?>

            </div>

        <?php } ?>



        <!-- FORM -->

        <form
            method="POST"
            onsubmit="return validateForm()"
        >


            <!-- NAME -->

            <div class="input-group">

                <label>
                    Full Name <span>*</span>
                </label>


                <input
                    type="text"
                    name="name"
                    id="name"
                    value="<?php

                        if (
                            isset($_POST["name"])
                        ) {

                            echo htmlspecialchars(
                                $_POST["name"]
                            );

                        } else {

                            echo htmlspecialchars(
                                $contact["name"]
                            );

                        }

                    ?>"
                    required
                >

            </div>



            <!-- EMAIL + PHONE -->

            <div class="input-row">


                <!-- EMAIL -->

                <div class="input-group">

                    <label>
                        Email Address <span>*</span>
                    </label>


                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="<?php

                            if (
                                isset($_POST["email"])
                            ) {

                                echo htmlspecialchars(
                                    $_POST["email"]
                                );

                            } else {

                                echo htmlspecialchars(
                                    $contact["email"]
                                );

                            }

                        ?>"
                        required
                    >

                </div>



                <!-- PHONE -->

                <div class="input-group">

                    <label>
                        Mobile Number <span>*</span>
                    </label>


                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        inputmode="numeric"
                        value="<?php

                            if (
                                isset($_POST["phone"])
                            ) {

                                echo htmlspecialchars(
                                    $_POST["phone"]
                                );

                            } else {

                                echo htmlspecialchars(
                                    $contact["phone"]
                                );

                            }

                        ?>"
                        required
                    >

                </div>

            </div>



            <!-- ADDRESS -->

            <div class="input-group">

                <label>
                    Address
                </label>


                <textarea
                    name="address"
                    rows="4"
                ><?php

                    if (
                        isset($_POST["address"])
                    ) {

                        echo htmlspecialchars(
                            $_POST["address"]
                        );

                    } else {

                        echo htmlspecialchars(
                            $contact["address"]
                        );

                    }

                ?></textarea>

            </div>



            <!-- UPDATE -->

            <button
                type="submit"
                class="submit-btn"
            >
                Update Contact →
            </button>



            <!-- CANCEL -->

            <a
                href="view.php"
                class="cancel-btn"
            >
                Cancel
            </a>


        </form>

    </div>

</section>


<script src="script.js"></script>

</body>

</html>