<?php
session_start();
require_once('../connection.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password-signup'], PASSWORD_BCRYPT); // Hash the password
    $email = mysqli_real_escape_string($conn, $_POST['email-signup']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $full_name = $first_name . ' ' . $last_name;
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']);
    $created_at = date('Y-m-d H:i:s');

    $check_query = "SELECT * FROM serviceproviders WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "Username is already taken.";
    } else {
        $sql = "INSERT INTO serviceproviders (username, password, email, full_name, phone, address, speciality, created_at)
                VALUES ('$username', '$password', '$email', '$full_name', '$phone', '$address', '$speciality', '$created_at')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = '../Login/login.php';
                  </script>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
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
</head>
<body>
    <div class="blurry-background"></div>
    <main>
        <h1>Welcome to EDSA Lanka Consultancy</h1>
        <div class="form-section">
            <section class="sign-up">
                <h2>Service Provider</h2>
                <form id="signup-form" method="post" action="">
                    <!-- Step 1 -->
                    <div id="step-1">
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

                        <button type="button" id="next-btn" class="sign-up-btn">Next</button>
                    </div>

                    <!-- Step 2 -->
                    <div id="step-2" style="display: none;">
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

                        <!-- <label for="password-signup"><b>Create a Password</b></label>
                        <input type="password" id="password-signup" name="password-signup" placeholder="Create your password" required>

                        <label for="password-confirm"><b>Confirm Password</b></label>
                        <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm your password" required> -->

                    <label for="specialized-fields"><b>Specialized Fields</b></label>
                    <div class="specialized-fields">
                        <div class="field-column">
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Development Finance"> Development Finance
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Micro Finance"> Micro Finance
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Gender Finance"> Gender Finance
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="SME Development"> SME Development
                            </label>
                        </div>
                        <div class="field-column">
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Strategic and Operations Planning"> Strategic and Operations Planning
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Institutional Development"> Institutional Development
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Community Development"> Community Development
                            </label>
                            <label>
                                <input type="checkbox" name="specialized-fields[]" value="Organizational Development"> Organizational Development
                            </label>
                        </div>
                    </div>
                            <label for="qualifications"><b>Qualifications</b></label>
                                <input type="text" id="qualifications" name="qualifications" placeholder="Enter your qualifications" required>
                            <label class="terms">
                                <input type="checkbox" name="terms" required> I agree with the <a href="Terms and Conditions/TC.html" target="iframe_tc">terms and conditions</a>.
                            </label>
                    <button type="button" id="back-btn" class="sign-up-btn">Back</button>
                    <button type="submit" id="submit-btn" class="sign-up-btn">Sign up</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer class="footer">
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
    <script>
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const nextBtn = document.getElementById('next-btn');
        const backBtn = document.getElementById('back-btn');

        nextBtn.addEventListener('click', () => {
            step1.style.display = 'none';
            step2.style.display = 'block';
        });

        backBtn.addEventListener('click', () => {
            step2.style.display = 'none';
            step1.style.display = 'block';
        });

        if (isset($_POST['specialized-fields'])) {
    $specialized_fields = implode(', ', $_POST['specialized-fields']);
} else {
    $specialized_fields = '';
}

    </script>
</body>
</html>
