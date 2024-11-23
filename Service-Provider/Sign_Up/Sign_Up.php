<?php
session_start();
require_once('../connection.php'); // Include the database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password-signup'], PASSWORD_BCRYPT); // Hash the password
    $email = mysqli_real_escape_string($conn, $_POST['email-signup']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $full_name = $first_name . ' ' . $last_name; // Combine first and last name for full_name
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']); // Get the selected radio button value
    $created_at = date('Y-m-d H:i:s'); // Current date and time

    // Check if the username already exists
    $check_query = "SELECT * FROM serviceproviders WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Username already exists
        $error_message = "Username is already taken.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO serviceproviders (username, password, email, full_name, phone, address, speciality, created_at)
                VALUES ('$username', '$password', '$email', '$full_name', '$phone', '$address', '$speciality', '$created_at')";

        if (mysqli_query($conn, $sql)) {
            // JavaScript alert for success and redirect to login page
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = 'login.php'; // Redirect to login page
                  </script>";
            exit; // Stop further script execution
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - Sign Up</title>
    <link rel="stylesheet" href="Sign_up.css">
    <style>
        .radio-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            align-items: center;
        }

        .radio-buttons label {
            flex: 1;
            text-align: center;
        }

        .radio-buttons input[type="radio"] {
            margin-right: 5px;
        }

        .terms a {
            color: #18A0FB; /* Initial light blue color */
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .terms a:visited {
            color: purple; /* Change to purple after visited */
        }
    </style>
</head>
<body>
    <div class="blurry-background"></div>
    <main>
        <h1>Welcome to EDSA Lanka Consultancy</h1>
        <div class="form-section">
            <section class="sign-up">
                <h2>Service Provider</h2>
                <form method="post" action="">
                    <label for="username"><b>Username</b></label>
                    <input type="text" id="username" name="username" placeholder="Choose a username" required>
                    <?php 
                        if (isset($error_message)) {
                            echo "<p style='color: red;'>$error_message</p>";
                        }
                    ?>

                    <label for="first-name"><b>First Name</b></label>
                    <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>
                    
                    <label for="last-name"><b>Last Name</b></label>
                    <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>
                    
                    <label for="email-signup"><b>Email Address</b></label>
                    <input type="email" id="email-signup" name="email-signup" placeholder="Enter your email" required>
                    
                    <label for="phone"><b>Phone Number</b></label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

                    <label for="address"><b>Address</b></label>
                    <input type="text" id="address" name="address" placeholder="Enter your address" required>

                    <label for="speciality"><b>Speciality</b></label>
                    <div class="radio-buttons">
                        <label>
                            <input type="radio" name="speciality" value="Consultant" required> Consultant
                        </label>
                        <label>
                            <input type="radio" name="speciality" value="Researcher" required> Researcher
                        </label>
                        <label>
                            <input type="radio" name="speciality" value="Trainer" required> Trainer
                        </label>
                    </div>
                    
                    <label for="password-signup"><b>Create a Password</b></label>
                    <input type="password" id="password-signup" name="password-signup" placeholder="Create your password" required>

                    <label for="password-confirm"><b>Confirm Password</b></label>
                    <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm your password" required>

                    <label class="terms">
                        <input type="checkbox" name="terms" required> I agree with the <a href="http://localhost/Service%20Provider/UI/Terms%20and%20Conditions/TC.html" target="iframe_tc">terms and conditions</a>.
                    </label>

                    <button type="submit" id="submit-btn" class="sign-up-btn">Sign up</button>
                </form>
            </section>
        </div>
    </main>
    <footer class="footer">
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>
</html>
