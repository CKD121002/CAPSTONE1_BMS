<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request for Barangay Clearance</title>
    <link rel="stylesheet" href="../css/CSS.css" />
<script src="../js/js.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body>
    <div class="container">
      <aside class="sidebar" id="sidebar">
       <div class="burgertab" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
          </div>
      <div class="sidebarcontent">
        <div class="sidebar-header">
          <div class="logosidebar">
            <img src="../picture/Logo.png" alt="Barangay Logo" id="sidebarLogo">
          </div>
        </div>

        <nav class="navlinks">
          <a href="../Frontend/Userdashboard.php">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
          </a>
          <a href="../Frontend/Profile.php">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
          </a>
          <a href="../Frontend/Request.php" class="active">
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Request a Document</span>
          </a>
          <a href="../Frontend/History.php">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
          </a>
          <a href="#">
            <i class="fa-solid fa-bell"></i>
            <span>Emergency Broadcast</span>
          </a>
          <div class="nav-divider"></div> 
          <a href="../Backend/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log out</span>
          </a>
        </nav>
      </div>
    </aside>

      <main class="maincontent">
        <div class="contentwrapper">
          <h1>Request for Barangay Clearance & Permits</h1>
<p>Please provide the details below to process your request.</p>

<form class="formsection" action="../Backend/submit_clearance.php" method="POST" enctype="multipart/form-data">
  <div class="formgroup">
    <h3>Personal Details</h3>
    <input type="text" name="fullname" placeholder="Full Name" required />
    <input type="date" name="birthdate" required />

    <h3>Document Type</h3>
    <select name="clearance_type" required>
      <option value="">-- Select Document --</option>
      <option value="barangay_clearance">Barangay Clearance</option>
      <option value="business_clearance">Business Clearance</option>
      <option value="barangay_permit">Barangay Permit</option>
    </select>
  </div>

  <div class="formgroup">
    <h3>Contact and Address</h3>
    <input type="text" name="phone" placeholder="Phone Number" required />
    <input type="email" name="email" placeholder="Email Address" required />
    <textarea name="address" placeholder="Current Address" rows="4" required></textarea>
  </div>

  <div class="formgroup" style="flex: 100%">
    <h3>Purpose of Request</h3>
    <input type="text" name="purpose" placeholder="e.g., Job requirement, Business application" required />

    <h3>Attachments</h3>
    <div class="uploadbox">
      <p>Upload any supporting documents (optional)</p>
      <input type="file" name="attachment" />
    </div>

    <div class="buttoncontainer">
      <button type="submit" class="btnsubmit">Submit Request</button>
      <button type="reset" class="btncancel">Cancel</button>
    </div>
  </div>
</form>
        </div>

        <footer class="footer">
          <div class="footerleft">
            <div class="footertext">
              A Centralized Web-based Management System Service
            </div>
          </div>
          <div class="footercenter">All Rights Reserved</div>
          <div class="footerright">Contact Info Part</div>
        </footer>
      </main>
    </div>
  </body>
</html>
