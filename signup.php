<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .signup-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
            margin: 20px;
        }
        .form-group label.required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
        .btn-signup {
            width: 150px; /* Adjust the width as needed */
            margin: 0 auto; /* Center the button horizontally */
            display: block; /* Make the button a block element */
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Sign Up</h1>
        <form action="signup_process.php" method="post" onsubmit="return validateForm()">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="first_name" class="required">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" pattern="[A-Za-z]+" title="Only alphabets are allowed" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" pattern="[A-Za-z]+" title="Only alphabets are allowed">
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name" class="required">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" pattern="[A-Za-z]+" title="Only alphabets are allowed" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone_number" class="required">Phone Number:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91</span>
                        </div>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="required">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="required">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="username" class="required">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="password" class="required">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="confirm_password" class="required">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block btn-signup">Sign Up</button>
        </form>

        <script>
            function validateForm() {
                // Validate email format
                let email = document.getElementById('email');
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email.value)) {
                    alert('Please enter a valid email address');
                    return false;
                }

                // Validate password match
                let password = document.getElementById('password');
                let confirm_password = document.getElementById('confirm_password');
                if (password.value !== confirm_password.value) {
                    alert('Passwords do not match');
                    return false;
                }

                return true;
            }
        </script>

        <?php if (isset($_GET['error'])): ?>
            <p class="message error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="message success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>