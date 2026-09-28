<?php

include "db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);


    /* =========================
       VALIDATION
    ========================= */

    if ($name == "" || $email == "" || $phone == "") {

        $message = "Please fill in all required fields.";
        $message_type = "error";

    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";
        $message_type = "error";

    }

    elseif (!preg_match("/^[0-9]{10}$/", $phone)) {

        $message = "Mobile number must contain exactly 10 digits.";
        $message_type = "error";

    }

    else {

        /* =========================
           INSERT CONTACT
        ========================= */

        $sql = "
            INSERT INTO contacts
            (name, email, phone, address)
            VALUES (?, ?, ?, ?)
        ";

        $stmt = mysqli_prepare($conn, $sql);


        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ssss",
                $name,
                $email,
                $phone,
                $address
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header("Location: view.php?success=added");

                exit();

            }

            else {

                $message = "Unable to add contact.";
                $message_type = "error";

            }


            mysqli_stmt_close($stmt);

        }

        else {

            $message = "Database error: " . mysqli_error($conn);
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

    <title>Add Contact | NovaTech</title>

    <link rel="stylesheet" href="style.css">

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


    <a href="index.php" class="nav-btn">
        ← Back
    </a>

</header>



<!-- ================= FORM ================= -->

<section class="form-section">

    <div class="form-card">


        <div class="form-header">

            <div class="large-icon">
                +
            </div>


            <p class="small-title">
                CONTACT MANAGEMENT
            </p>


            <h1>
                Add New <span>Contact</span>
            </h1>


            <p>
                Enter the details of your new contact.
            </p>

        </div>



        <!-- ERROR MESSAGE -->

        <?php if ($message != "") { ?>

            <div class="<?php echo $message_type; ?>">

                <?php echo htmlspecialchars($message); ?>

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
                    placeholder="Enter full name"
                    value="<?php
                        echo isset($_POST["name"])
                            ? htmlspecialchars($_POST["name"])
                            : "";
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
                        placeholder="example@gmail.com"
                        value="<?php
                            echo isset($_POST["email"])
                                ? htmlspecialchars($_POST["email"])
                                : "";
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
                        placeholder="Enter 10-digit mobile number"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        inputmode="numeric"
                        value="<?php
                            echo isset($_POST["phone"])
                                ? htmlspecialchars($_POST["phone"])
                                : "";
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
                    placeholder="Enter address"
                    rows="4"
                ><?php
                    echo isset($_POST["address"])
                        ? htmlspecialchars($_POST["address"])
                        : "";
                ?></textarea>

            </div>



            <!-- SUBMIT -->

            <button
                type="submit"
                class="submit-btn"
            >
                Save Contact →
            </button>



            <!-- CANCEL -->

            <a
                href="index.php"
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