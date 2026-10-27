<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/* =========================
   ADMIN LOGIN DETAILS
========================= */

$admin_username = "kairos";
$admin_password = "Alka@4523";

/* =========================
   LOGIN CHECK
========================= */

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username == $admin_username && $password == $admin_password){

        $_SESSION['admin'] = $username;

        header("Location: index.php");
        exit();

    }else{

        $error = "Invalid Username or Password";

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Salon Admin Login</title>

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
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    position:relative;
    background:
    linear-gradient(135deg,#0f172a 0%, #111827 40%, #1e293b 100%);
}

/* =========================
   BACKGROUND GLOW
========================= */

body::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;
    background:#7c3aed;
    filter:blur(140px);
    opacity:0.25;
    top:-120px;
    left:-120px;
}

body::after{
    content:"";
    position:absolute;
    width:450px;
    height:450px;
    background:#ec4899;
    filter:blur(140px);
    opacity:0.20;
    bottom:-150px;
    right:-120px;
}

/* =========================
   LOGIN BOX
========================= */

.login-container{
    position:relative;
    z-index:2;
    width:100%;
    max-width:420px;
    padding:20px;
}

.login-box{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(16px);
    -webkit-backdrop-filter:blur(16px);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:28px;
    padding:40px 35px;
    box-shadow:
    0 25px 60px rgba(0,0,0,0.35),
    inset 0 1px 0 rgba(255,255,255,0.05);
    animation:fadeUp 0.7s ease;
}

/* =========================
   LOGO
========================= */

.logo{
    width: 85px;
    height: 85px;
    margin: auto;
    margin-bottom: 22px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ed3a3a, #f75555);
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 32px;
    font-weight: 700;
    box-shadow: 0 12px 35px rgb(169 169 169 / 40%);
    overflow: hidden;
}
.logo img {
    width: 85px;
    height: 85px;
    display: block;
}

/* =========================
   HEADING
========================= */

.login-box h2{
    text-align:center;
    font-size:30px;
    font-weight:700;
    color:#fff;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#cbd5e1;
    font-size:14px;
    margin-bottom:30px;
}

/* =========================
   ERROR
========================= */

.error{
    background:rgba(239,68,68,0.12);
    border:1px solid rgba(239,68,68,0.25);
    color:#fecaca;
    padding:14px;
    border-radius:14px;
    margin-bottom:20px;
    text-align:center;
    font-size:14px;
}

/* =========================
   INPUTS
========================= */

.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    margin-bottom:8px;
    color:#e2e8f0;
    font-size:14px;
    font-weight:500;
}

.input-group input{
    width:100%;
    height:55px;
    border:none;
    outline:none;
    border-radius:16px;
    padding:0 18px;
    font-size:14px;
    color:#fff;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.08);
    transition:0.35s ease;
}

.input-group input::placeholder{
    color:#94a3b8;
}

.input-group input:focus{
    border-color:#a855f7;
    box-shadow:0 0 0 4px rgba(168,85,247,0.18);
    background:rgba(255,255,255,0.12);
}

/* =========================
   BUTTON
========================= */

.login-btn{
    width: 100%;
    height: 56px;
    border: none;
    border-radius: 16px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #ed3a3a, #f75555);
    transition: 0.35s ease;
    box-shadow: 0 12px 30px rgb(247 85 85 / 35%);
}

.login-btn:hover{
        transform: translateY(-3px);
    box-shadow: 0 18px 40px rgb(247 85 85 / 45%);
}

/* =========================
   FOOTER
========================= */

.footer-text{
    text-align:center;
    margin-top:22px;
    font-size:13px;
    color:#94a3b8;
}

/* =========================
   ANIMATION
========================= */

@keyframes fadeUp{

    from{
        opacity:0;
        transform:translateY(40px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/* =========================
   MOBILE
========================= */

@media(max-width:480px){

    .login-box{
        padding:30px 24px;
        border-radius:22px;
    }

    .login-box h2{
        font-size:24px;
    }

}

</style>

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <!-- LOGO -->

        <div class="logo">
            <img src="https://kairosglamdubai.com/images/Kairos-Logo.jpg" loading="lazy" alt="logo">
        </div>

        <!-- HEADING -->

        <h2>Salon Admin</h2>

        <div class="subtitle">
            Secure dashboard login access
        </div>

        <!-- ERROR -->

        <?php
        if(isset($error)){
            echo "<div class='error'>$error</div>";
        }
        ?>

        <!-- FORM -->

        <form method="POST">

            <div class="input-group">

                <label>Username</label>

                <input
                type="text"
                name="username"
                placeholder="Enter Username"
                required>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input
                type="password"
                name="password"
                placeholder="Enter Password"
                required>

            </div>

            <button
            type="submit"
            name="login"
            class="login-btn">

                Login to Dashboard

            </button>

        </form>

        <!-- FOOTER -->

        <div class="footer-text">
            © <?php echo date("2021"); ?> Salon Management Panel
        </div>

    </div>

</div>

</body>

</html>