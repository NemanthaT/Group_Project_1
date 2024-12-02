<?php
session_start();
include '../../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $email = mysqli_real_escape_string($conn, $_POST['email-signup']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $full_name = $first_name . ' ' . $last_name;
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $created_at = date('Y-m-d H:i:s');
    $password = rand(100000, 999999);

    // Check for duplicate email
    $check_query = "SELECT * FROM clients WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "Email is already registered.";
    } else {
        // Insert data into providerrequests table
        $sql = "INSERT INTO clients (full_name, email, phone, address, password)
                VALUES ('$full_name', '$email', '$phone', '$address', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = '../../../Home/Homepage/HP.html';
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="blurry-background"></div>
    <main>
        <h1>Welcome to EDSA Lanka Consultancy</h1>
        <div class="form-section">
            <section class="sign-up">
                <h2>User</h2>
                <form id="signup-form" method="post" action="">
                    <!-- Step 1 -->
                    <div id="step-1">
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
    </script>
</body>
</html>
