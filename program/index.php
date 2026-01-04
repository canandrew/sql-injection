<?php
/*
SQL Injection by Andrew Myrden

index.php PURPOSE:
PHP file for the index (home) page of the demo. Displays a sample 'admin login' which
is vulnerable to SQL Injection, due to a lack of input sanitization.

Created 2026-01-04
*/

require 'scripts/connect.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>canandrew | sql-injection</title>
    <link rel="stylesheet" href="styles/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Essential styles for the demo */
        #win { display: none; }
        #feedback { color: red; }
        #login-form-container { /* Renamed outer div for clarity */ } 
    </style>
</head>


<body>
    <div id="disclaimer">
        <h1>⚠️ Disclaimer</h1>
        <p>This is a demo website created for educational purposes only. It is intentionally vulnerable to SQL Injection attacks to demonstrate the risks associated with improper input handling. Do not use this code or techniques in any production environment.</p>
    </div>

    <div id="container">
        <div id="single-column">
            <div id="login-form"> 
                <h1>LateCode Login</h1>

                <h3 style="margin-bottom: 20px;"><i>NOT Case sensitive!</i></h3>

                <form id="login-form-data" style="margin-bottom: 20px;"> 
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" maxlength="32" required><br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" maxlength="32" required><br><br>

                    <div id="feedback"></div><br>

                    <button type="submit">Submit</button>
                </form>
            </div>
            
            <div id="win">
                <img src="media/party-parrot.gif" alt="Party Parrot" style="width:100px;height:100px;">
                <h1>🎉 Login Successful!</h1>
                <p>Congratulations! You have successfully logged in as an admin.</p>
                <p>This indicates that you have exploited the SQL Injection vulnerability in the login form (or used a demo login).</p>
                <p>Remember, this is for educational purposes only. Always sanitize and validate user inputs in real applications to prevent such vulnerabilities.</p>
            </div>

        </div>
    </div>

    <div id="footer">
        <div id="footer-text-container">
            <p>2026-01-04 | Andrew Myrden (canandrew)</p>
        </div>
    </div>

    <script>
        // Attach event listener to the form submission
        document.getElementById('login-form-data').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default page reload

            const form = event.target;
            const formData = new FormData(form);
            const feedbackDiv = document.getElementById('feedback');
            const loginFormDiv = document.getElementById('login-form');
            const winDiv = document.getElementById('win');

            feedbackDiv.innerText = ''; // Clear previous feedback

            // Send data to the vulnerable PHP script
            fetch('scripts/check-login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === 'SUCCESS') {
                    // Correct login: Hide form and show win div
                    loginFormDiv.style.display = 'none';
                    winDiv.style.display = 'block';
                } else {
                    // Incorrect login: Display the feedback from the server
                    feedbackDiv.innerText = result.trim() || 'Login failed.';
                }
            })
            .catch(error => {
                console.error('AJAX Error:', error);
                feedbackDiv.innerText = 'An unexpected network error occurred.';
            });
        });
    </script>

</body>
</html>