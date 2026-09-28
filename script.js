// =====================================
// DELETE CONFIRMATION
// =====================================

function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this contact?"
    );

}



// =====================================
// FORM VALIDATION
// =====================================

function validateForm() {

    const name =
        document.getElementById("name");

    const phone =
        document.getElementById("phone");


    // NAME VALIDATION

    if (name && name.value.trim() === "") {

        alert(
            "Please enter the contact name."
        );

        name.focus();

        return false;

    }


    // MOBILE NUMBER VALIDATION

    if (phone) {

        const mobile =
            phone.value.trim();


        // Check exactly 10 digits

        if (!/^[0-9]{10}$/.test(mobile)) {

            alert(
                "Please enter a valid 10-digit mobile number."
            );

            phone.focus();

            return false;

        }

    }


    return true;

}



// =====================================
// SEARCH CONTACTS
// =====================================

function searchContacts() {

    const input =
        document.getElementById(
            "searchInput"
        );


    const filter =
        input.value.toLowerCase();


    const table =
        document.getElementById(
            "contactTable"
        );


    const rows =
        table.getElementsByTagName(
            "tr"
        );


    for (
        let i = 1;
        i < rows.length;
        i++
    ) {

        const text =
            rows[i]
            .textContent
            .toLowerCase();


        if (
            text.includes(filter)
        ) {

            rows[i].style.display = "";

        }

        else {

            rows[i].style.display = "none";

        }

    }

}