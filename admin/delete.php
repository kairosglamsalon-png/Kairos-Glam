<?php

session_start();

/* =========================
   ADMIN LOGIN CHECK
========================= */

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

/* =========================
   ERROR REPORTING
========================= */

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* =========================
   DATABASE CONNECTION
========================= */

$host = "localhost";
$username = "u495081033_salon";
$password = "Salon@123!";
$database = "u495081033_salon";

$conn = mysqli_connect($host, $username, $password, $database);

/* =========================
   CHECK CONNECTION
========================= */

if(!$conn){

    die("Connection Failed: " . mysqli_connect_error());

}

/* =========================
   DELETE BOOKING
========================= */

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);

    /* CHECK RECORD EXISTS */

    $checkSql = "SELECT * FROM bookings WHERE id = '$id'";

    $checkResult = mysqli_query($conn, $checkSql);

    if(mysqli_num_rows($checkResult) > 0){

        /* DELETE QUERY */

        $deleteSql = "DELETE FROM bookings WHERE id = '$id'";

        if(mysqli_query($conn, $deleteSql)){

            header("Location: index.php?deleted=success");
            exit();

        }else{

            echo "
            <div style='
                font-family:Poppins,sans-serif;
                padding:20px;
                background:#fee2e2;
                color:#b91c1c;
                border-radius:12px;
                max-width:500px;
                margin:40px auto;
                text-align:center;
            '>

                <h2>Delete Failed</h2>

                <p>" . mysqli_error($conn) . "</p>

            </div>
            ";

        }

    }else{

        echo "
        <div style='
            font-family:Poppins,sans-serif;
            padding:20px;
            background:#fef3c7;
            color:#92400e;
            border-radius:12px;
            max-width:500px;
            margin:40px auto;
            text-align:center;
        '>

            <h2>Booking Not Found</h2>

            <p>The selected booking does not exist.</p>

        </div>
        ";

    }

}else{

    echo "
    <div style='
        font-family:Poppins,sans-serif;
        padding:20px;
        background:#fee2e2;
        color:#b91c1c;
        border-radius:12px;
        max-width:500px;
        margin:40px auto;
        text-align:center;
    '>

        <h2>Invalid Request</h2>

        <p>No booking ID received.</p>

    </div>
    ";

}

/* =========================
   CLOSE CONNECTION
========================= */

mysqli_close($conn);

?>