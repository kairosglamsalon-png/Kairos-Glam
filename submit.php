<?php

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

// Check Connection

if (!$conn) {

    die("Connection Failed: " . mysqli_connect_error());

}

/* =========================
   GET FORM DATA
========================= */

$name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');

$phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');

$email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');

/* =========================
   MULTIPLE SERVICES
========================= */

$service = '';

if(isset($_POST['service']) && is_array($_POST['service'])){

    // Remove empty values
    $filtered_services = array_filter($_POST['service']);

    // Convert array to string
    $service = implode(', ', $filtered_services);

    // Secure string
    $service = mysqli_real_escape_string($conn, $service);

}

$date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');

$time = mysqli_real_escape_string($conn, $_POST['time'] ?? '');

$message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');

/* =========================
   INSERT QUERY
========================= */

$sql = "INSERT INTO bookings
(name, phone, email, service, booking_date, booking_time, message)

VALUES

('$name', '$phone', '$email', '$service', '$date', '$time', '$message')";

/* =========================
   EXECUTE QUERY
========================= */

if (mysqli_query($conn, $sql)) {

    $text = "📌 New Appointment Booking\n\n";

    $text .= "👤 Name: $name\n";
    $text .= "📞 Phone: $phone\n";
    $text .= "📧 Email: $email\n";
    $text .= "💄 Services: $service\n";
    $text .= "📅 Date: $date\n";
    $text .= "⏰ Time: $time\n";
    $text .= "📝 Message: $message";

    $encodedMessage = urlencode($text);

    $whatsappNumber = "971521564527";

    mysqli_close($conn);

    echo "
<!-- Google tag (gtag.js) -->
<script async src='https://www.googletagmanager.com/gtag/js?id=AW-18539658786'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-18539658786');

  var waUrl = 'https://wa.me/$whatsappNumber?text=$encodedMessage';
  var redirected = false;
  function go(){ if(!redirected){ redirected = true; window.location.href = waUrl; } }

  gtag('event', 'conversion', {
    'send_to': 'AW-18539658786/Sx1ICLau5qsdEKL8sohF',
    'value': 1.0,
    'currency': 'INR',
    'event_callback': go
  });
  setTimeout(go, 1500); // fallback if the callback never fires
</script>
";

    exit();

} else {

    echo "Database Error: " . mysqli_error($conn);

}

mysqli_close($conn);

?>
