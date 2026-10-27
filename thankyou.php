<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Kairos Glam | Thank You</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>

@font-face{
    font-family:'Kugile';
    src:url('https://www.adverbcommunications.com/kairosglam/font/Kugile_Demo.ttf') format('truetype');
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;

    overflow:hidden;

    background:
    linear-gradient(rgba(0,0,0,0.60), rgba(0,0,0,0.60)),
    url('https://www.adverbcommunications.com/kairosglam/images/hero-banner-img.webp');

    background-size:cover;
    background-position:center;

    position:relative;
}

/* Glow Effects */

body::before{
    content:'';

    position:absolute;

    width:420px;
    height:420px;

    border-radius:50%;

    background:rgba(212,175,55,0.12);

    top:-120px;
    right:-80px;

    filter:blur(120px);
}

body::after{
    content:'';

    position:absolute;

    width:320px;
    height:320px;

    border-radius:50%;

    background:rgba(255,255,255,0.06);

    bottom:-100px;
    left:-80px;

    filter:blur(100px);
}

/* Main Box */

.thank-box{

    width:90%;
    max-width:550px;

    padding:55px 40px;

    text-align:center;

    border-radius:32px;

    background:rgba(18,18,18,0.72);

    backdrop-filter:blur(18px);

    border:1px solid rgba(255,255,255,0.08);

    box-shadow:
    0 15px 45px rgba(0,0,0,0.35),
    inset 0 1px 1px rgba(255,255,255,0.06);

    position:relative;

    z-index:2;

    animation:fadeUp 1s ease;
}

/* Success Icon */

.icon{
    width: 100px;
    height: 100px;
    margin: auto auto 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #b32025;
    color: #ffffff;
    font-size: 42px;
    box-shadow: 0 10px 35px #e9666a61;
}

/* Line */

.line{
    width:70px;
    height:2px;
    background: #b32025;
    margin:0 auto 25px;
}

/* Heading */

h1{
    font-size:58px;

    color:#fff;

    margin-bottom:15px;

    font-family:'Cormorant Garamond',serif;

    font-weight:600;

    letter-spacing:1px;
}

/* Text */

p{
    color:rgba(255,255,255,0.78);

    line-height:1.9;

    font-size:15px;

    margin-bottom:35px;
}

/* Button */

.home-btn{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 34px;
    border-radius: 60px;
    text-decoration: none;
    background: #b32025;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1px;
    transition: 0.4s ease;
}

.home-btn:hover{
    transform:translateY(-4px);

    box-shadow:0 10px 25px #cb3c4169;
}

/* Floating Particles */

.particle{
    position:absolute;

    width:10px;
    height:10px;

    border-radius:50%;

    background:rgba(255,255,255,0.15);

    animation:float 8s linear infinite;
}

.particle:nth-child(1){
    top:15%;
    left:12%;
}

.particle:nth-child(2){
    top:75%;
    right:18%;
    width:14px;
    height:14px;
}

.particle:nth-child(3){
    bottom:15%;
    left:25%;
    width:8px;
    height:8px;
}

/* Animation */

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

@keyframes float{

    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-20px);
    }

    100%{
        transform:translateY(0px);
    }

}

/* Mobile */

@media(max-width:600px){

    .thank-box{
        padding:45px 25px;
        border-radius:25px;
    }

    h1{
        font-size:42px;
    }

    p{
        font-size:14px;
        line-height:1.8;
    }

    .icon{
        width:85px;
        height:85px;
        font-size:34px;
    }

    .home-btn{
        width:100%;
    }

}

</style>
</head>

<body>

<!-- Floating Particles -->

<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>

<!-- Thank You Box -->

<div class="thank-box">

    <div class="icon">
        <i class="fa-solid fa-check"></i>
    </div>

    <div class="line"></div>

    <h1>Thank You</h1>

    <p>
        Your booking has been submitted successfully.  
        Our beauty experts will contact you shortly to confirm your appointment.
    </p>

    <a href="index.html" class="home-btn">
        <i class="fa-solid fa-arrow-left"></i>
        BACK TO HOME
    </a>

</div>

</body>
</html>