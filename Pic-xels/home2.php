<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: /picxels/home.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "picxels";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

$sql = "SELECT firstname, lastname FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
} else {
    $firstname = "";
    $lastname = "";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picxels - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>

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
    font-weight: 900;
    font-family: Verdana;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
}

.header .subtext {
    position: absolute;
    top: 66%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family:Tahoma;
    font-size: 90px; 
    font-weight: bolder;
}

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

.username {
    color: #6b2a7d; 
    font-family: Verdana;
    font-weight: 700;
    font-size: 60px;
    text-align: right;
    padding: 70px 20px; 
    text-decoration: none;
}

.list {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex; 
    justify-content: center; 
    font-size: 70px;
    font-family: verdana;
    font-weight: bold;
    color: #6b2a7d;
}

.list-item {
    cursor: pointer;
    padding: 10px 90px;
}

.list-item:last-child {
    border-right: none;
}

.content {
    display: none;
    padding: 20px;
    margin-top: 10px;
}

.selected {
    background-color: #6b2a7d;
    color: white;
    border-radius: 100px;
    padding-top: 20px;
    padding-bottom: 20px;
}

.image-container {
    position: relative;
    display: inline-block;
}
  
.image-container img {
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    padding: 10px;
    box-sizing: border-box;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.image-overlay p {
    color: white;
    margin: 0;
    font-family: Verdana;
    font-size: 50px;
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

<body>

<div class="navbar">
    <img src="\picxels\picxels.png">
    <img src="\picxels\user.jpg" height="150">
        <?php if (!empty($firstname) && !empty($lastname)) : ?>
            <span class="username"><?php echo htmlspecialchars($firstname . " " . $lastname); ?></span>
        <?php endif; ?>
        <a href="#" id="logoutLink"> LogOut </a>
        <a href="#about">About</a>
        <a href="\picxels\upload.php">Upload</a>
        <a href="#" id="exploreLink">Explore</a>
</div>

<script>
    document.getElementById("logoutLink").addEventListener("click", function(event) {
        event.preventDefault(); 
        alert("You are now logged out");
        window.location.href = "/picxels/home.php";
    });
</script>

<div class="header">

    <header>
        <img src="\picxels\imgs\lubov-tandit.jpg" width="100%" alt="Header Image">
        <div class="text">PICXELS</div>
        <div class="subtext">The best free stock photos, royalty free<br> 
            images & videos shared by creators.<br></div>
    </header>
</div>


<br><br><br><br><br><br>

<div class="list">
    <div class="list-item" onclick="showContent('picxels')">Picxels</div>
    <div class="list-item" onclick="showContent('recents')">Recents</div>
    <div class="list-item" onclick="showContent('trending')">Trending </div> 
  </div>

  <br><br><br>
  
  <div class="content" id="picxels">
    <center>
    <table cellpadding="50px">
        <td> <div class="image-container">
        <img src="\picxels\imgs\valeriia-miller.jpg" height="1500px" width="1000px">
        <div class="image-overlay"><p> ROSES- A picxels original </p></div>
        </td>

        <td rowspan="2"> <div class="image-container">
        <img src="\picxels\imgs\stijn-dijkstra.jpg" height="3100px">
        <div class="image-overlay"><p> RAJ- A Picxels original </p></div></td>

        <td> <div class="image-container"> 
        <img src="\picxels\imgs\rehan-verma.jpg" height="1500px"> 
        <div class="image-overlay"><p> Fort View </p></div></td> 

        <tr>

        <td> <div class="image-container">
        <img src="\picxels\imgs\shvets-anna.jpg" height="1500px">
        <div class="image-overlay"><p> A certain busy unknown street </p></div></td>

        <td> <div class="image-container">
        <img src="\picxels\imgs\monstera-production.jpg" height="1500px" width="1000px">
        <div class="image-overlay"><p> PRIDE- A picxles original </p></div></td>
        <tr>

        <td colspan="2"> <div class="image-container">
        <img src="\picxels\imgs\pexels-pixabay-206359.jpg" height="1500px" width="3200px">
        <div class="image-overlay"><p> ROSE SKY- A picxels original </p></div></td>
        
        <td> <div class="image-container">
        <img src="\picxels\imgs\nataliya-vaitkevich.jpg" height="1500px" width="1000px">
        <div class="image-overlay"><p> Craving Strawberries?  </p></div></td>

        <tr>

        <td> <div class="image-container">
        <img src="\picxels\imgs\mitbg.jpg" height="1500px">
        <div class="image-overlay"><p>DAISIES- A picxels original</p></div></td>

        <td> <div class="image-container">
        <img src="\picxels\imgs\marshall-jones.jpg" height="1500px" width="2100px">
        <div class="image-overlay"><p> A special lavender field </p></div></td>

        <td> <div class="image-container"> 
        <img src="\picxels\imgs\lumn.jpg" height="1500px" width="1000px">
        <div class="image-overlay"><p>  Why not Code with Flowers? </p></div></td>


    </table>
    </center>
  </div>
  
<div class="content" id="recents">
    <center>
        <table cellpadding="50px">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "picxels");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT * FROM upload ORDER BY id DESC LIMIT 9"; 
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                echo "<tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<td>";
                    echo "<div class='image-container'>";
                    echo "<img src='img/" . $row["image"] . "' height= '1600' width= '1100' alt=''>";
                    echo "<div class='image-overlay'><p>" . $row["name"] . "</p></div>";
                    echo "</div>";
                    echo "</td>";
                    $i++;
                    if ($i % 3 == 0) {
                        echo "</tr><tr>";
                    }
                }
                while ($i % 3 != 0) {
                    echo "<td></td>";
                    $i++;
                }
                echo "</tr>";
            } else {
                echo "<tr><td>No images found.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
    </center>
</div>


  
  <div class="content" id="trending">
    <center>
        <table cellpadding="50px">
            <td colspan="2"> <div class="image-container">
            <img src="\picxels\imgs\pexels-thisisengineering-3861969.jpg" height="1500px"> 
            <div class="image-overlay"><p> AI or HUMAN? </p></div></td>
            
            <td colspan="2"> <div class="image-container">
            <img src="\picxels\imgs\pexels-pavel-danilyuk-8439094.jpg" height="1500px"> 
            <div class="image-overlay"><p> Cheers to the future! </p></div></td>
            
            <tr>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-megan-forbes-963436.jpg" height="1500px">
            <div class="image-overlay"><p> Barbie Roof? </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-pixabay-326005.jpg" height="1500px">
            <div class="image-overlay"><p> An Apple a day? </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-suzy-hazelwood-3682153.jpg" height="1500px">
            <div class="image-overlay"><p> Rewind to the past </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-taryn-elliott-6790339.jpg" height="1500px">
            <div class="image-overlay"><p> A vacation? Why not? </p></div></td>
            
            <tr>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pixabay.jpg" height="1500px" width="1130px">
            <div class="image-overlay"><p> A picxels original </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-anna-tukhfatullina-food-photographerstylist-2611810.jpg" height="1500px" width="1000px">
            <div class="image-overlay"><p> Fruit Splash </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-arthur-brognoli-2440524.jpg" height="1500px" width="1150px">
            <div class="image-overlay"><p> A picxels trend </p></div></td>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-дарья-шелкович-5010657.jpg" height="1500px" width="1000px">
            <div class="image-overlay"><p> SUN-GIRL-FLOWER - A picxels original </p></div></td>
            
            <tr>
            
            <td> <div class="image-container">
            <img src="\picxels\imgs\pexels-pixabay-264950.jpg" height="1500px" width="1130px">
            <div class="image-overlay"><p> Smell Bliss </p></div></td>
            
            <td colspan="3"> <div class="image-container">
            <img src="\picxels\imgs\pexels-eberhard-grossgasteiger-1004665.jpg" height="1500px" width="3500px">
            <div class="image-overlay"><p> ICE- A picxels original </p></div></td>
            
          </table>
    </center>
  </div>
  
  <script>
    function showContent(contentId) {
      var contents = document.querySelectorAll('.content');
      contents.forEach(function(content) {
        content.style.display = 'none';
      });

      var selectedContent = document.getElementById(contentId);
      if (selectedContent) {
        selectedContent.style.display = 'block';
      }
  
      var listItems = document.querySelectorAll('.list-item');
      listItems.forEach(function(item) {
        item.classList.remove('selected');
      });
  
      var selectedItem = document.querySelector('[onclick="showContent(\'' + contentId + '\')"]');
      if (selectedItem) {
        selectedItem.classList.add('selected');
      }
    }

    window.onload = function() {
        showContent('picxels');
    };
</script>

<script>
    document.getElementById("exploreLink").addEventListener("click", function(event) {
        event.preventDefault(); 
        showContent('trending'); 
    });
</script>

<br><br><br><br><br><br><br><br><br>

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