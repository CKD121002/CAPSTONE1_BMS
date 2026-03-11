<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Isidro</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <header class="topnav">
        <div class="logo-area">
            <img src="../picture/silogo.png" alt="San Isidro Logo" class="logo1">
            <img src="../picture/Home.png" alt="One Cainta Logo" class="logo2">
        </div>
    </header>

    <div class="fullbg">
        <section class="topp">
            <div class="top-logo">
                <img src="../picture/silogo.png" alt="silogo">
            </div>

            <div class="login-form">
                <a href="login.php" class="back-btn">← Back</a>
                <h2>REGISTER</h2>
                <form action="../Backend/register1.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="accountType">Who is the owner of the account?</label>
                        <select id="accountType" name="account_type" required>
                            <option value="" disabled selected>Select account type</option>
                            <option value="resident">Brgy. San Isidro Resident</option>
                            <option value="official">Brgy. Official</option>
                        </select>
                    </div>

                    <div class="form-group department-group">
                        <label for="department">From what department are you from?</label>
                        <select id="department" name="department" required>
                            <option value="" disabled selected>Select department</option>
                            <option value="admin">Admin Office</option>
                            <option value="bpso">BPSO</option>
                            <option value="clearance">Clearance Office</option>
                            <option value="lupon">Lupon Office</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fullName">Name</label>
                        <input type="text" id="fullName" name="name" placeholder="Enter your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="tel" id="contact" name="contact_number" placeholder="Enter your contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="proof">Proof of Valid ID</label>
                        <input type="file" id="proof" name="proof" accept="image/*,application/pdf" required>
                    </div>
                    <div class="form-group">
                        <label for="idNumber">ID Number</label>
                        <input type="text" id="idNumber" name="id_number" placeholder="Enter your ID Number" required>
                    </div>

                    <button type="submit">Confirm</button>
                </form>
            </div>
        </section>
    </div>

    <script src="../js/register.js"></script>
</body>
</html>