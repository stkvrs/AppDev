<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require_once __DIR__ . "/models/summary.php";
    storeSummary();
    $result = getSummary();
    
    ?>

    <ul class="nav justify-content-end">
        <li class="nav-item mr-5 mt-5">
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        </li>
    </ul>
    <h1 class="my-1">Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Here are today's symmary.</h1>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Country</th>
                <th scope="col">Total Cases</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Get the countries from generic JSON
            $countries = $result['Countries'];

            foreach ($countries as $key=>$country) {?>
            <tr>
                <th scope="row"><?php echo ++$key;?></th>
                <td><?php echo $country['Country'];?></td>
                <td><?php echo $country['TotalConfirmed'];?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
</body>

</html>