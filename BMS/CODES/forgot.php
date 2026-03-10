<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Isidro</title>
    <link rel="stylesheet" href="/BMS/STYLE/forgot.css">
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
                    <a href="/BMS/CODES/login.php" class="back-btn">← Back</a>
                    <h2>Forgot Password</h2>
                    <form action="login1.php" method="POST">
                        <div class="form-group">
                        </div>
                            <div class="form-group">
                                <label>Enter New Password</label>
                                <input type="password" placeholder="Enter your new password" required>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" placeholder="Re-enter your password" required>
                            </div>
                        <button type="submit">Confirm</button>
                    </form>
                </div>
        </section>
    </div>
</body>
</html>