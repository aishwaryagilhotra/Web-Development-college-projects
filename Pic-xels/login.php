<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "picxels";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = $lastname = $email = $password = "";
$showError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        echo "<script>alert('Login Successful'); window.location.href= '/picxels/home2.php';</script>";
        exit(); 
    } else {
        $showError = "Login Unsuccesful. Please check your credentials.";
        echo "<script>alert('$showError'); window.location.href= '/picxels/login.php';</script>";
    }
}
?>

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picxels - Login </title>

</head>

<style>

.navbar {
    overflow: hidden;
    background-color: white; 
}

.navbar a {
    float: right;
    display:block;
    color: #6b2a7d;
    font-family: Verdana;
    font-weight: 700;
    font-size: 60px;
    text-align: right;
    padding: 70px 80px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #ddd; 
    color: black;
}

.header {
    position: relative;
    text-align: center;
    color: white; 
}

.header img {
    width: 100%; 
    height: auto; 
    filter: blur(4px);
}

.header .text {
    position: absolute;
    top: 25%;
    left: 20%;
    transform: translate(-50%, -50%);
    font-size: 120px;
    font-weight: 700;
    font-family: Verdana;
    color:white;
}

.header .subtext {
    position: absolute;
    top: 33%;
    left: 24%;
    transform: translate(-50%, -50%);
    font-family:Tahoma;
    font-size: 70px; 
    color:white;
}


.container {
    background-image: url("/picxels/bgimg.png"); 
    background-size: cover;
    display: flex;
    flex-direction: center;
    max-width: 4000px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 80px;
    overflow: hidden;
    margin: 0 auto; 
    padding: 150px;
}

.left-side {
    flex: 1;
    padding: 20px;
}
.right-side {
    flex: 1;
    overflow: hidden;
    position: relative;
}

.right-side img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 50px;
}

.content {
        padding: 20px;
}

.big-sentence {
    font-size: 100px;
    font-weight: 500;
    font-family: cursive;
    color: #6b2a7d
    margin-bottom: 10px;
}

.small-sentence {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 55px; 
    margin-bottom: 20px;
}

.list {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 70px;  
    font-weight: 150px;
    color:grey;
    margin-bottom: 20px;
    font-size: 50px;
    list-style-type: none; 
}

.bold {
    color:black;
}

li::before {
    content: "\2714"; 
    display: inline-block;
    width: 1em; 
    color: #6b2a7d; 
    margin-right: 5px; 
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 70%;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 20px;
    font-size: 60px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

input[type="submit"]{
    padding: 10px 20px;
    background-color: black; 
    color: white; 
    border: 1px solid #ccc;
    border-radius: 30px;
    font-size: 50px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    cursor: pointer;
    width: 73%;
    padding: 30px;
    transition: background-color 0.3s; 

}

.footer {
    background-image: url("/picxels/Q.png"); 
    background-size: cover;
    color: black;
    padding: 20px;
    text-align: left;
    vertical-align: top; 
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.footer-content {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
}

.big-text {
    font-size: 130px;
    font-weight: 600;
    font-family: Verdana;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.small-text {
    font-size: 60px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-bottom: 20px;
}

.footer img {
    border-radius: 50px;
}

</style>
</head>

<body>

<div class="navbar">
    <img src="\picxels\picxels.png">
        <a href="\picxels\home.php">Home</a>
        <a href="\picxels\register.php">Register</a>
        <a href="#about">About</a>
</div>

<div class="header">

    <header>
        <img src="\picxels\newimgs\pexels-ánh-đặng-183219231.jpg" width="100%" alt="Header Image">
        <div class="text">PICXELS- LOGIN </div>
        <div class="subtext">Re-Enter into the world of picxels in a few clicks!<br></div>
    </header>
</div>

<br><br><br><br><br><br><br><br><br>

    <div class="container">
        <div class="left-side">
            <div class="content">
            
                <p class="big-sentence"> 
                    Where your photography is seen, used, and loved by the world.</p>
                <p class="small-sentence">SHARE YOUR PHOTOS & VIDEOS IN ONE OF <br> THE 
                    LARGEST FREE LIBRARIES OF <br>VISUAL CONTENT ON THE INTERNET.</p>

                <ul class=list> <li> Reach a global audience of <br> more than <div class=bold>30 million. </div></li><br>
                <li> Help bring to life the ideas of <div class=bold> creative people all over the world. </div></li><br>
                <li> Join more than 320K of<div class=bold> incredibly talented photographers. </div></li></p><br>
                <p class="small-sentence">Don't have an account? <a href=\picxels\register.php> Register here </a></p>
                <br><br><br>
        

                <form method="post" action="login.php">

<div class="form-group">
<label for="email">Enter a valid Email ID</label>
<input type="text" name="email" required placeholder="Email"></div><br>

<div class="form-group">
<label for="password"> Enter Password</label>
<input type="password" name="password" required placeholder="Password"></div><br>

<input type="submit" value="Login">
</form>
</div></div>

<div class="right-side">
    <img src="\picxels\newimgs\pexels-giona-mason-20343073.jpg" alt="Background Image">
  </div>

</div>

<?php
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }
?>

<br><br><br><br><br><br>


<div class="footer">
<a name= "about"></a>
  <table cellpadding="250px">
  <td> <img src="\picxels\newimgs\pexels-jadson-thomas-1535775.jpg" height="2000px"> </td>
  <td>
  <div class="big-text">WHEN CREATIVITY IS SHARED AND USED FREELY, EVERYONE WINS.</div> <br>
  <div class="small-text">
    <ul> 
      <li> On your website, blog or app - Use the photos and videos online – whether it’s a website, 
        e-commerce shop, newsletter, e-book, presentation, blog or a template you sell. </li> <br>
      <li> Promote your product - Create unique ads, banners and marketing campaigns with 
        photos from Pexels and promote your product. </li> <br>
      <li> Print marketing material - Use the photos for flyers, postcards, invitations, 
        magazines, albums, books, CD covers and more. </li> <br>
      <li> Share them on social media - Grow your audience by posting authentic and engaging 
        photos and videos on social media like Facebook, Instagram or YouTube. </li> <br>
    </ul>
  </td>
  </table>
  </div>
</div>

</body>
</html>