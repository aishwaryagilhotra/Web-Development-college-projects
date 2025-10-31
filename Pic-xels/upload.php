<?php
$conn = mysqli_connect("localhost", "root", "", "picxels");

if(isset($_POST["submit"])) {
    if (isset($_FILES["image"])) {
        $name = $_POST["name"];
        if($_FILES["image"]["error"] === 4) {
            echo "<script>alert('Image does not exist');</script>";
        } else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } else {
                if (!file_exists('img')) {
                    mkdir('img');
                }

                $newImageName = uniqid() . '.' . $imageExtension;

                if (move_uploaded_file($tmpName, 'img/'. $newImageName)) {
                    $query = "INSERT INTO upload VALUES ('', '$name', '$newImageName')";
                    mysqli_query($conn, $query);
                    echo "<script>alert('Successfully added. You\'ll find your uploaded img in the Recents tab of Picxels Homepage!'); window.location.href= '/picxels/home2.php';</script>";
                } else {
                    echo "<script>alert('Failed to move uploaded file');</script>";
                }
            }
        }
    } else {
        echo "No file uploaded.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picxels - Upload </title>

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
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 150px;
    font-weight: 700;
    font-family: Verdana;
    color:white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
    
.header .subtext {
    position: absolute;
    top: 60%;
    left: 50%;
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

button[type="submit"]{
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

input[type="file"] {
    padding: 10px 20px;
    background-color: white; 
    color: black; 
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
            <a href="#about">About</a>
    </div>
    
    <div class="header">
    
        <header>
            <img src="\picxels\newimgs\pexels-digital-buggu-167533.jpg" width="100%" alt="Header Image">
            <div class="text"> UPLOAD </div>
            <div class="subtext"> Insert pixels into the world of picxels in a few clicks!<br></div>
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

                <ul class=list> <li> Step 1 <div class=bold> Enter the image you wish to upload </div></li><br>
                <li> Step 2 <div class=bold> Give your image its identity and Upload! </div></li><br>
                <li> Step 3 <div class=bold> You'll find your uploaded pexels <br> in 'Recents' at 'Home' of Picxels.  </div></li></p>
                <br><br><br>
        

                <form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Caption of your Image </label>
<input type="text" name="name" id= "name" required placeholder="Image Caption"></div><br>

<div class="form-group">
<label for="Image"> Enter Image </label>
<input type="file" name="image" id= "image" required placeholder="Select Image" accept=".jpg, .jpeg, .png"></div><br>

<button type="submit" name="submit">Upload</button>
</form>
</div></div>

<div class="right-side">
    <img src="\picxels\newimgs\pexels-tuba-nur-dogan-20240213.jpg" alt="Background Image">
  </div>

</div>

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