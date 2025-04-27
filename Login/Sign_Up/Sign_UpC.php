<?php
session_start();
require_once('../../config/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - Sign Up</title>
    <link rel="stylesheet" href="Sign_up.css">
    <script src="Sign_Up.js"></script>
</head>

<body>
    <div class="blurry-background"></div>
    <div id="errorView">
        <button id="closeError" onclick="closeError()">x</button>
        <center>
            <h2 class="error-title"></h2>
            <p class="error-message"></p>
        </center>
    </div>
    <div id="overlay" class="overlay"></div>
    <main>
        <div class="form-section" id="form-section">
            <div class="left">
                <div class="left-content">
                    <h2>Join as a Client</h2>
                    <p>Find the right professional services for your needs.</p>

                    <ul class="benefit-list">
                        <li>Access to verified service providers</li>
                        <li>Seamless booking experience</li>
                        <li>Secure payment system</li>
                        <li>Direct communication with professionals</li>
                    </ul>
                </div>

            </div>
            <div class="sign-up">
                <h1>Welcome to EDSA Lanka Consultancy</h1>

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

                        <center><button type="submit" id="submit-btn" class="sign-up-btn">Sign up</button><br>
                            <a href="switch.php" class="back-link">Back to account selection</a>
                        </center>
                    </div>
                </form>
            </div>
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