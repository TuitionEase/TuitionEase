<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuitionEase</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP -->

    <!-- OPENSANS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Overpass&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- OPENSANS -->

    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="..\images\logo.png" alt="TuitionEase" style=" width: 330px; margin-left: -100px; margin-top: 10px;"></img>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#services">Our Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#reviews">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#ourteam">Our Team</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              
            </ul>
            <!-- <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            <a href="./Login & Signup/login.html"><button class="loginbut">Login</button></a>
          </div>
        </div>
      </nav>
    <!-- NAVBAR ENDS -->



    <!-- BANNER STARTS -->



    <div class="main mt-3">
        <div class="row">
            <div class="col-lg-6 img-cont">
                <h2 class="heading1">Simplifying Tuition Management</h2>
                <h2 class="heading2">for Tutors Everywhere</h2>
                <p class="heading3">TutionEase is your all-in-one platform for simplified tuition management.</p>
                <p class="heading4">Streamline scheduling, payments, and communication with ease.</p>
    
                <div class="buts">
                <button class="but1" onclick="window.location.href='signupT.html'">Sign Up as Tutor</button>
                <button class="but2" onclick="window.location.href='signupG.html'">Sign Up as Guardian</button>

                </div>
            </div>
            <div class="col-lg-6 home">
                <div class="title p-5 pos_cen">
                    <img src="images\Banner2.png" style="width: 1100px;" class="home-img">
                </div>
            </div>
        </div>
    </div>
    

    <!-- BANNER ENDS-->



    <!-- OUR SERVICES -->
    <div class="services" id="services">
        <div>
            <h2 class="serv-head">Our Services</h2>
        </div>
    </div>
    <div class="container">
    <div class="slide-container active">
        <div class="slide">
            <div class="content">
                <h3 class="servicehead">Manage Study Materials</h3>
                <p class="servicep">Ensures easy access, organization, and optimization of your academic resources. </p>
                <a href="#" class="btn">Learn more</a>
            </div>
            <div class="image">
                <img src="images\study material1.png">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <h3 class="servicehead">Schedule Management</h3>
                <p class="servicep">User-friendly schedule maintenance tools, designed to optimize your time and profit.</p>
                <a href="#" class="btn">Learn more</a>
            </div>
            <div class="image">
                <img src="images\schedule1.png">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <h3 class="servicehead">Track Classes</h3>
                <p class="servicep">Effortlessly monitor class progress and student performance with our intuitive tracking system</p>
                <a href="#" class="btn">Learn more</a>
            </div>
            <div class="image">
                <img src="images\trackclass1.png">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <h3 class="servicehead">Student Details</h3>
                <p class="servicep">Access extensive student information, allowing for personalized tutoring sessions. </p>
                <a href="#" class="btn">Learn more</a>
            </div>
            <div class="image">
                <img src="images\details1.png">
            </div>
        </div>
    </div>
    
    <div id="prev" onclick="prev()"> < </div>
    <div id="next" onclick="next()"> > </div>
</div>

<!-- OUR SERVICES ENDS -->


<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to fetch the first 5 rows from the review table
$sql = "SELECT id, name, des, user_type, dp FROM review LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="reviews" id="reviews">
            <div>
                <h2 class="rev-head">Reviews</h2>
            </div>
          </div>
          <div class="revcontainer">
            <div class="testimonial mySwiper swiper-container">
              <div class="testi-content swiper-wrapper">';

    // Fetch and display each review
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $des = htmlspecialchars($row['des'], ENT_QUOTES, 'UTF-8');
        $user_type = htmlspecialchars($row['user_type'], ENT_QUOTES, 'UTF-8');
        $dp = htmlspecialchars($row['dp'], ENT_QUOTES, 'UTF-8');

        echo <<<HTML
            <div class="slide1 swiper-slide">
               
                <p>{$des}</p>
                <i class="fa-solid fa-quote-left quote-icon" style="color: #0a8ff5;"></i>
                <div class="details">
                    <span class="name">{$name}</span>
                    <span class="job">{$user_type}</span>
                </div>
            </div>
HTML;
    }

    echo '</div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>';
} else {
    echo '<p>No reviews available.</p>';
}

// Close database connection
$conn->close();
?>



<!--/////////////////////////////--> 
<!--/////////////////////////////--> 
<!--/////////////////////////////--> 
<!--/////////////////////////////--> 

    <div class="container"> 
        <!-- Sec Title --> 
        <div class="sec-title centered"> 
            <div class="title">Our Team</div> 
           

        </div> 

        <div class="row clearfix" id="ourteam"> 
            <!-- Team Block --> 
            <div class="team-block col-lg-4 col-md-6 col-sm-12"> 
                <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"> 
                    <ul class="social-icons"> 
                        <li><a href="https://www.facebook.com/RatnajitDharPrantar/"><i class="fab fa-facebook-f"></i></a></li> 
                        <li><a href="https://www.linkedin.com/in/ratnajit-dhar/"><i class="fab fa-linkedin-in"></i></a></li> 

                        <li><a href="https://github.com/ratnajit-dhar"><i class="fab fa-github"></i></a></li> 
                    </ul> 
                    <div class="image"> 
                        <a href="#"><img src="images\Ratnajit_Dhar.png" alt="" /></a> 
                    </div> 
                    <div class="lower-content"> 
                        <h3><a href="#">Ratnajit Dhar</a></h3> 
                        <div class="designation">Web Developer</div> 
                      <p> A tranquil soul guided by boundless dreams and an unyielding passion for learning. I am like a quiet river flowing steadily towards their dreams, always seeking new knowledge to fuel their journey.</p> 
                    </div> 
                </div> 
            </div> 
            <!-- Team Block --> 
            <div class="team-block col-lg-4 col-md-6 col-sm-12"> 
                <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"> 
                    <ul class="social-icons"> 
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> 
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> 

                        <li><a href="#"><i class="fab fa-twitter"></i></a></li> 
                    </ul> 
                    <div class="image"> 
                        <a href="#"><img src="images\Arpita.jpg" alt="" /></a> 
                    </div> 
                    <div class="lower-content"> 
                        <h3><a href="#">Arpita Mallik </a></h3> 
                        <div class="designation">Web Developer</div> 
                       <p>A diligent and well-organized individual. My relentless work ethic and structured approach ensure tasks are tackled efficiently, leaving no room for chaos.</p> 
                    </div> 
                </div> 
            </div> 
            <!-- Team Block --> 
            <div class="team-block col-lg-4 col-md-6 col-sm-12"> 
                <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"> 
                    <ul class="social-icons"> 
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> 
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> 

                        <li><a href="#"><i class="fab fa-twitter"></i></a></li> 
                    </ul> 
                    <div class="image"> 
                        <a href="#"><img src="images\Fariha.jpg" alt="" /></a> 
                    </div> 
                    <div class="lower-content">
                        <h3><a href="#">Faozia Fariha</a></h3> 
                            <div class="designation">Web Developer</div> 
                           <p>An indefatigable individual who never gives up. With unwavering determination, they persistently strive to overcome challenges, embodying resilience and dedication in all endeavors.</p> 
                        </div> 
                    </div> 
                </div> 
              <!-- Team Block --> 
            </div> 
        </div>
    


    <!-- OUR TEAM ENDS -->




    <!-- FOOTER -->
    <footer class="footer-distributed" id="about">

        <div class="footer-left">
            <img class="logo" src="images\logo.png" alt="TuitionEase" style=" width: 500px; margin-top: -60px; margin-left: -90px;"></img>

            <p class="footer-links" style="margin-top:-10px;">
                <a href="index.html">Home</a>
                |
                <a href="#services">Our Services</a>
                |
                <a href="#reviews">Reviews</a>
                |
                <a href="#ourteam">Our Team</a>
            </p>

            <p class="footer-company-name">Copyright © 2024 <strong>TuitionEase</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i>
                <p><span>CUET</span>
                    Chattogram</p>
            </div>

            <div>
                <i class="fa-solid fa-phone" style="color: #74C0FC;"></i>
                <p>+88 74**9**258</p>
            </div>
            <div>
                <i class="fa-solid fa-envelope" style="color: #74C0FC;"></i>
                <p><a href="arpitamallik13@gmail.com">tuitionease@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>TuitionEase</strong> is your personalized tutoring solution! Our experienced tutors are dedicated to helping students excel in their studies. With customized lessons and convenient online sessions, we're here to support your academic journey. Join us today and unlock your full potential with TuitionEase!
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa-brands fa-facebook" style="color: #007fe0;"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin" style="color: #3477ea;"></i></i></a>
    
            </div>
        </div>
    </footer>


    <!-- FOOTER ENDS -->



    <script src="index.js"></script>

    <script src="swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
</body>
</html>