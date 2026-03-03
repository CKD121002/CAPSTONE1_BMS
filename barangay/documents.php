<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

/* COUNT PER DOCUMENT TYPE */
function countDocs($type, $conn){
    $stmt = $conn->prepare("SELECT COUNT(*) as total 
                            FROM document_requests 
                            WHERE document_type=? 
                            AND status='Pending'");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['total'];
}

$business   = countDocs("Barangay Business Permit Certificate",$conn);
$indigency  = countDocs("Barangay Indigency Certificate",$conn);
$residency  = countDocs("Barangay Residency Certificate",$conn);
$clearance  = countDocs("Barangay Clearance",$conn);
$idcard     = countDocs("Barangay ID Card",$conn);
$ownership  = countDocs("Barangay Ownership Certificate",$conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>Documents</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<?php include 'sidebar.php'; ?>

<div class="content">
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <div class="doc-grid">

            <div class="doc-card teal">
                <h5>Barangay Business Permit Certificate</h5>
                <div class="count"><?= $business ?></div>
                <a href="document_list.php?type=Barangay Business Permit Certificate">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

            <div class="doc-card green">
                <h5>Barangay Indigency Certificate</h5>
                <div class="count"><?= $indigency ?></div>
                <a href="document_list.php?type=Barangay Indigency Certificate">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

            <div class="doc-card yellow">
                <h5>Barangay Residency Certificate</h5>
                <div class="count"><?= $residency ?></div>
                <a href="document_list.php?type=Barangay Residency Certificate">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

            <div class="doc-card green">
                <h5>Barangay Clearance</h5>
                <div class="count"><?= $clearance ?></div>
                <a href="document_list.php?type=Barangay Clearance">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

            <div class="doc-card green">
                <h5>Barangay ID Card</h5>
                <div class="count"><?= $idcard ?></div>
                <a href="document_list.php?type=Barangay ID Card">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

            <div class="doc-card red">
                <h5>Barangay Ownership Certificate</h5>
                <div class="count"><?= $ownership ?></div>
                <a href="document_list.php?type=Barangay Ownership Certificate">
                    More info <i class="fa fa-info-circle"></i>
                </a>
            </div>

        </div>
    </div>

</div>

<script src="script.js"></script>
</body>
</html>