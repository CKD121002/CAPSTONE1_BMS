<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Isidro</title>
    <link rel="stylesheet" href="/BMS/STYLE/login.css">
</head>
<body>
    <header class="topnav">
        <div class="logo-area">
            <img src="/BMS/IMAGES/silogo.png" alt="San Isidro Logo" class="logo1">
            <img src="/BMS/IMAGES/Home.png" alt="One Cainta Logo" class="logo2">
        </div>
    </header>

    <div class="fullbg">
        <section class="topp">
            <div class="top-logo">
                <img src="/BMS/IMAGES/silogo.png" alt="silogo">
            </div>
                <div class="login-form">
                    <a href="/BMS/index.php" class="back-btn">← Back</a>
                    <h2>LOGIN</h2>
                    <form action="/BMS/BACKEND/login1.php" method="POST">
                        <div class="form-group">
                            <label for="role">Who is the owner of the account?</label>
                            <select id="role" name="account_type" required>
                                <option value="" disabled selected>Select account type</option>
                                <option value="resident">Brgy. San Isidro Resident</option>
                                <option value="official">Brgy. Official</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Enter your username" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>

                        <div class="form-links">
                            <a href="/BMS/CODES/forgot_pass.php">Forget password? Click here</a>
                            <a href="/BMS/CODES/register.php">No account yet? Register here!</a>
                        </div>

                        <button type="submit">Confirm</button>
                    </form>
                </div>
        </section>
    </div>

<!-- Password reset popup -->
    <div id="popup-message" class="popup-overlay">
        <div class="popup-box">
            <h3 id="popup-title">Password Reset</h3>
            <p id="popup-text">
                We will be sending you a confirmation email shortly.<br>
                Please check your inbox or spam.
            </p>
            <button type="button" onclick="closePopup()">OK</button>
        </div>
    </div>

    <!-- Login error toast -->
    <?php if (isset($_GET['error'])): ?>
        <div id="toast" class="toast show">
            <span class="toast-icon">⚠</span>
            <span>Invalid Login. Try again!</span>
            <button type="button" class="toast-close" onclick="closeToast()">×</button>
        </div>
    <?php endif; ?>

    <!-- Registration popup -->
    <?php if (isset($_GET['register']) && $_GET['register'] === 'pending'): ?>
        <div id="register-popup" class="popup-overlay show">
            <div class="popup-box register-hold-popup">
                <h3>Registration Submitted</h3>
                <p>
                    Your account is still on hold. Please wait for the admin at least 24 hours to approve your account.
                </p>
                <p>
                    You may receive a notification via SMS or email.
                </p>
                <button type="button" onclick="closeRegisterPopup()">OK</button>
            </div>
        </div>
    <?php endif; ?>

    <script src="/BMS/STYLE/login.js"></script>
    
</body>
</html>