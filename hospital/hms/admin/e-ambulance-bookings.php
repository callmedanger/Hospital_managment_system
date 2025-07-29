<?php
session_start();
include('../include/config.php');
include('../include/checklogin.php');
check_login();
// Delete booking if requested
if (isset($_GET['del']) && is_numeric($_GET['del'])) {
    $del_id = intval($_GET['del']);
    $del_query = mysqli_query($con, "DELETE FROM ambulance_bookings WHERE id='$del_id'");
    if ($del_query) {
        echo '<script>alert("Booking deleted successfully.");window.location.href="e-ambulance-bookings.php";</script>';
        exit;
    } else {
        echo '<script>alert("Error deleting booking.");window.location.href="e-ambulance-bookings.php";</script>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>e-Ambulance Bookings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body>
<div id="app">
<?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="e-ambulance-bookings">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="mainTitle">e-Ambulance Bookings</h2>
                            <div style="margin-bottom:15px;">
                                <a href="all-ambulance-locations.php" target="_blank" class="btn btn-success">
                                    <i class="fa fa-map-marker"></i> View All Locations
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Landmark</th>
                                            <th>Day</th>
                                            <th>Type</th>
                                            <th>With Doctor</th>
                                            <th>With Paramedic</th>
                                            <th>Oxygen</th>
                                            <th>Ventilator</th>
                                            <th>Fees (PKR)</th>
                                            <th>Booked At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $q = "SELECT ab.*, u.fullName FROM ambulance_bookings ab LEFT JOIN users u ON ab.user_id = u.id ORDER BY ab.created_at DESC";
                                    $res = mysqli_query($con, $q);
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($res)) {
                                        echo '<tr>';
                                        echo '<td>' . $i++ . '</td>';
                                        echo '<td>' . htmlentities($row['name']) . '</td>';
                                        echo '<td>' . htmlentities($row['fullName']) . '</td>';
                                        echo '<td>' . htmlentities($row['phone']) . '</td>';
                                        echo '<td>' . htmlentities($row['address']) . '</td>';
                                        echo '<td>' . htmlentities($row['day']) . '</td>';
                                        echo '<td>' . htmlentities($row['type']) . '</td>';
                                        echo '<td>' . ($row['with_doctor'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['with_paramedic'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['oxygen'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['ventilator'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . htmlentities($row['fees']) . '</td>';
                                        echo '<td>' . htmlentities($row['created_at']) . '</td>';
                                        echo '<td>';
                                        echo '<a href="?del=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this booking?\')" class="btn btn-danger btn-sm" style="margin-right:5px;"><i class="fa fa-trash"></i></a>';
                                        echo '<a href="view-ambulance-map.php?lat=' . urlencode($row['latitude']) . '&lng=' . urlencode($row['longitude']) . '&name=' . urlencode($row['fullName']) . '" target="_blank" class="btn btn-info btn-sm" title="View on Map"><i class="fa fa-map-marker"></i></a>';
                                        echo '<a href="../ambulance-tracker.php?booking_id=' . $row['id'] . '" target="_blank" class="btn btn-success btn-sm" title="Go Ambulance"><i class="fa fa-ambulance"></i> Go Ambulance</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
