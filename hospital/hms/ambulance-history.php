<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ambulance Booking History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body>
<div id="app">
<?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="ambulance-history">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="mainTitle">Ambulance Booking History</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>With Doctor</th>
                                            <th>With Paramedic</th>
                                            <th>Oxygen</th>
                                            <th>Ventilator</th>
                                            <th>Fees (PKR)</th>
                                            <th>Day</th>
                                            <th>Booked At</th>
                                            <th>Map</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $userid = $_SESSION['id'];
                                    $q = "SELECT * FROM ambulance_bookings WHERE user_id='$userid' ORDER BY created_at DESC";
                                    $res = mysqli_query($con, $q);
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($res)) {
                                        echo '<tr>';
                                        echo '<td>' . $i++ . '</td>';
                                        echo '<td>' . htmlentities($row['type']) . '</td>';
                                        echo '<td>' . ($row['with_doctor'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['with_paramedic'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['oxygen'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . ($row['ventilator'] ? 'Yes' : 'No') . '</td>';
                                        echo '<td>' . htmlentities($row['fees']) . '</td>';
                                        echo '<td>' . htmlentities($row['day']) . '</td>';
                                        echo '<td>' . htmlentities($row['created_at']) . '</td>';
                                        echo '<td>';
                                        echo '<a href="view-ambulance-map.php?lat=' . urlencode($row['latitude']) . '&lng=' . urlencode($row['longitude']) . '&name=' . urlencode($row['name']) . '" target="_blank" class="btn btn-info btn-sm" title="View on Map"><i class="fa fa-map-marker"></i></a>';
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
        <?php include('include/footer.php'); ?>
        <?php include('include/setting.php'); ?>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html> 