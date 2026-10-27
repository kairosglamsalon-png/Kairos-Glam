<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

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

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

/* =========================
   FETCH BOOKINGS
========================= */

$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$totalBookings = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Salon Admin Dashboard</title>

<!-- Favicons -->
  <link href="https://kairosglamdubai.com/images/favicon.png" rel="icon">
  <link href="https://kairosglamdubai.com/images/apple-touch-icon.png" rel="apple-touch-icon">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins', sans-serif;
    background:linear-gradient(135deg,#0f172a 0%, #111827 40%, #1e293b 100%);
    min-height:100vh;
    padding:25px;
    color:#fff;
}

.dashboard{
    width:100%;
    margin:auto;
    background:rgba(255,255,255,0.06);
    backdrop-filter:blur(14px);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:28px;
    padding:30px;
    box-shadow:0 20px 60px rgba(0,0,0,0.35);
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:28px;
}

.top-bar h1{
    font-size:34px;
    font-weight:800;
    color:#fff;
}

.top-bar h1 span{
    color:#b32025;
}

.logout-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:13px 24px;
    border-radius:14px;
    background:linear-gradient(135deg, #c72d2d, #f76e55);
    color:#fff;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:0.35s ease;
}

.logout-btn:hover{
    transform:translateY(-3px);
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
    margin-bottom:30px;
}

.stat-card{
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:22px;
    padding:22px;
}

.stat-card h3{
    font-size:14px;
    font-weight:500;
    color:#cbd5e1;
    margin-bottom:12px;
}

.stat-card h2{
    font-size:30px;
    font-weight:700;
    color:#fff;
    letter-spacing:1px;
}

.table-wrapper{
    overflow-x:auto;
    border-radius:24px;
    border:1px solid rgba(255,255,255,0.08);
    background:rgba(255,255,255,0.03);
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:1200px;
}

table thead{
    background:rgba(255,255,255,0.06);
}

table th{
    padding:18px;
    text-align:left;
    font-size:13px;
    font-weight:600;
    color:#e2e8f0;
    border-bottom:1px solid rgba(255,255,255,0.08);
}

table td{
    padding:18px;
    border-bottom:1px solid rgba(255,255,255,0.05);
    color:#f8fafc;
    font-size:14px;
    vertical-align:middle;
}

table td:nth-child(5){
    vertical-align:top;
}

table tbody tr{
    transition:0.3s ease;
}

table tbody tr:hover{
    background:rgba(255,255,255,0.04);
}

/* =========================
   COLUMN WIDTH
========================= */

table th:nth-child(5),
table td:nth-child(5){
    width:360px;
    min-width:360px;
}

table th:nth-child(8),
table td:nth-child(8){
    width:240px;
}

/* =========================
   SERVICE TAGS
========================= */

.service-tags{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    align-items:center;
}

.tag{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 12px;
    border-radius:999px;
    background:rgba(247,85,85,0.14);
    border:1px solid rgba(247,85,85,0.22);
    color:#ffd6d6;
    font-size:11px;
    font-weight:500;
    line-height:1.2;
    transition:0.3s ease;
}

.tag:hover{
    background:rgba(247,85,85,0.24);
    transform:translateY(-2px);
}

.more-tag{
    cursor:pointer;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.12);
    color:#ffffff;
}

.more-tag:hover{
    background:rgba(255,255,255,0.16);
}

.extra-services{
    display:none;
    margin-top:10px;
    gap:8px;
    flex-wrap:wrap;
    width:100%;
}

.extra-services.active{
    display:flex;
}

.no-service{
    color:#94a3b8;
    font-size:13px;
}

/* =========================
   MESSAGE BOX
========================= */

.message-box{
    max-width:260px;
    line-height:1.7;
    color:#cbd5e1;
    white-space:normal;
    word-break:break-word;
}

/* =========================
   DELETE BUTTON
========================= */

.delete-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff;
    text-decoration:none;
    padding:11px 16px;
    border-radius:12px;
    font-size:13px;
    font-weight:600;
    transition:0.35s ease;
}

.delete-btn:hover{
    transform:translateY(-2px);
}

.no-data{
    text-align:center;
    padding:50px;
    font-size:16px;
    color:#cbd5e1;
}

/* =========================
   MOBILE RESPONSIVE
========================= */

@media(max-width:768px){

    body{
        padding:12px;
    }

    .dashboard{
        padding:18px;
    }

    .top-bar{
        flex-direction:column;
        align-items:flex-start;
    }

    .top-bar h1{
        font-size:25px;
    }

    .logout-btn{
        width:100%;
    }

}

/* =========================
   MOBILE RESPONSIVE
========================= */

@media(max-width:992px){

    table{
        min-width:1000px;
    }

    .dashboard{
        padding:22px;
    }

    .top-bar h1{
        font-size:28px;
    }

}

@media(max-width:768px){

    body{
        padding:10px;
    }

    .dashboard{
        padding:16px;
        border-radius:20px;
    }

    .top-bar{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .top-bar h1{
        font-size:24px;
        line-height:1.3;
    }

    .logout-btn{
        width:100%;
        padding:14px;
        text-align:center;
    }

    .stats-grid{
        grid-template-columns:1fr;
        gap:14px;
    }

    .stat-card{
        padding:18px;
        border-radius:18px;
    }

    .stat-card h3{
        font-size:13px;
    }

    .stat-card h2{
        font-size:24px;
    }

    .table-wrapper{
        overflow-x:auto;
        border-radius:18px;
    }

    table{
        min-width:900px;
    }

    table th,
    table td{
        padding:14px;
        font-size:13px;
    }

    .message-box{
        max-width:220px;
        font-size:13px;
        line-height:1.6;
    }

    .tag{
        font-size:10px;
        padding:6px 10px;
    }

    .delete-btn{
        padding:10px 14px;
        font-size:12px;
        border-radius:10px;
    }

}

@media(max-width:480px){

    body{
        padding:8px;
    }

    .dashboard{
        padding:14px;
        border-radius:16px;
    }

    .top-bar h1{
        font-size:20px;
    }

    .logout-btn{
        font-size:13px;
        padding:12px;
    }

    .stat-card{
        padding:16px;
    }

    .stat-card h2{
        font-size:20px;
    }

    table{
        min-width:800px;
    }

    table th,
    table td{
        padding:12px;
        font-size:12px;
    }

    .message-box{
        max-width:180px;
        font-size:12px;
    }

    .tag{
        font-size:9px;
        padding:5px 9px;
    }

    .delete-btn{
        padding:9px 12px;
        font-size:11px;
    }

}

/* =========================
   BETTER MOBILE TABLE UI
========================= */

@media(max-width:768px){

    /* Date + Time Column */
    table td:nth-child(6),
    table td:nth-child(7){
        min-width:120px;
    }

    table td:nth-child(6) .tag,
    table td:nth-child(7) .tag{
        display:inline-block;
        width:100%;
        text-align:center;
        padding:8px 10px;
        border-radius:10px;
        font-size:11px;
        line-height:1.4;
    }

    /* Message Box */
    .message-box{
        min-width:220px;
        max-width:220px;
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(255,255,255,0.06);
        padding:12px;
        border-radius:14px;
        font-size:12px;
        line-height:1.7;
        color:#e2e8f0;
    }

    /* Better table spacing */
    table td{
        vertical-align:top;
    }

}

@media(max-width:480px){

    table td:nth-child(6),
    table td:nth-child(7){
        min-width:100px;
    }

    table td:nth-child(6) .tag,
    table td:nth-child(7) .tag{
        font-size:10px;
        padding:7px 8px;
    }

    .message-box{
        min-width:180px;
        max-width:180px;
        padding:10px;
        font-size:11px;
        line-height:1.6;
    }

}

.table-wrapper::-webkit-scrollbar{
    height:6px;
}

.table-wrapper::-webkit-scrollbar-track{
    background:rgba(255,255,255,0.05);
}

.table-wrapper::-webkit-scrollbar-thumb{
    background:#b32025;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="dashboard">

<div class="top-bar">

    <h1>
        Salon <span>Dashboard</span>
    </h1>

    <a class="logout-btn" href="logout.php">
        Logout
    </a>

</div>

<div class="stats-grid">

    <div class="stat-card">
        <h3>Total Bookings</h3>
        <h2><?php echo $totalBookings; ?></h2>
    </div>

    <div class="stat-card">
        <h3>Today's Date</h3>
        <h2><?php echo date("d M Y"); ?></h2>
    </div>

    <div class="stat-card">
        <h3>Current Time</h3>
        <h2 id="liveClock"></h2>
    </div>

</div>

<div class="table-wrapper">

<table>

<thead>

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Service</th>
    <th>Date</th>
    <th>Time</th>
    <th>Message</th>
    <th>Action</th>

</tr>

</thead>

<tbody>

<?php

if($totalBookings > 0){

    $serial = 1;

    while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $serial++; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['phone']); ?></td>

<td><?php echo htmlspecialchars($row['email']); ?></td>

<td>

<?php

if(!empty($row['service'])){

    $services = explode(",", $row['service']);

    $limitedServices = array_slice($services, 0, 4);

    $remainingServices = array_slice($services, 4);

?>

    <div class="service-tags">

        <?php foreach($limitedServices as $service){ ?>

            <span class="tag">
                <?php echo htmlspecialchars(trim($service)); ?>
            </span>

        <?php } ?>

        <?php if(count($remainingServices) > 0){ ?>

            <span class="tag more-tag"
                  onclick="toggleServices(<?php echo $row['id']; ?>)">

                +<?php echo count($remainingServices); ?> More

            </span>

        <?php } ?>

    </div>

    <?php if(count($remainingServices) > 0){ ?>

        <div class="extra-services"
             id="extra-<?php echo $row['id']; ?>">

            <?php foreach($remainingServices as $service){ ?>

                <span class="tag">
                    <?php echo htmlspecialchars(trim($service)); ?>
                </span>

            <?php } ?>

        </div>

    <?php } ?>

<?php

}else{

    echo '<span class="no-service">No Service</span>';

}

?>

</td>

<td>
    <span class="tag">
        <?php echo htmlspecialchars($row['booking_date']); ?>
    </span>
</td>

<td>
    <span class="tag">
        <?php echo htmlspecialchars($row['booking_time']); ?>
    </span>
</td>

<td class="message-box">
    <?php echo nl2br(htmlspecialchars($row['message'])); ?>
</td>

<td>

<a class="delete-btn"
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this booking?')">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="9" class="no-data">
    No Bookings Found
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<script>

function updateClock(){

    let now = new Date();

    let time = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });

    document.getElementById("liveClock").innerHTML = time;

}

setInterval(updateClock, 1000);

updateClock();

function toggleServices(id){

    let extraBox = document.getElementById("extra-" + id);

    if(extraBox.classList.contains("active")){

        extraBox.classList.remove("active");

    }else{

        extraBox.classList.add("active");

    }

}

</script>

</body>

</html>