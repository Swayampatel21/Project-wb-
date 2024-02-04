<?php
session_start();
$email = $_SESSION['email'];
$user = $_SESSION['username'];
$pass = $_SESSION['password'];
$_SESSION['sesName'] = $row['mname'];
$_SESSION['username'] = $_POST['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .custom-icon {
            height: 60px;
            width: 90px;
        }
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .search-form {
            display: flex;
            width: 80%;
            max-width: 400px;
           
            border-radius: 20px;
        }
        #search-input {
            flex: 1;
            padding: 10px;
            border: none;
            border-color: #007BFF; 
        }
        #search-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Watch Better</title>

    <!-- CSS FILES -->
    <link rel="icon" href="watch better.png" type="image/x-icon" class="">
    <link rel="shortcut icon" href="watch better.png" type="image/x-icon" class="custom-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;400;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-festava-live.css" rel="stylesheet">
    <style>
        .movie-card {
            width: 100%;
            max-width: 300px;
            margin: 0 auto 20px;
        }

        .movie-card {
            width: 120%;
            height: 100%;
        }

        img {
            height: 100%;
            width: 100px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
    </style>
</head>

<body>

<main>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="Home.php">
                <span class="navbar-brand-text">
                    Watch Better
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center ms-auto me-lg-5">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_1">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_2">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_3">Movies</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_6">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="location.php">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section" id="section_1">
        <div class="section-overlay"></div>

        <div class="container d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="col-12 mt-auto mb-5 text-center">
                    <small>Watch Better Presents</small>
                    <h1 class="text-white mb-5">Watch Better</h1>
                    <a class="btn custom-btn smoothscroll" href="#section_2">Let's begin</a>
                </div>

                <div class="col-lg-12 col-12 mt-auto d-flex flex-column flex-lg-row text-center">

                    

                    <div class="social-share">
                        <ul class="social-icon d-flex align-items-center justify-content-center">
                            <span class="text-white me-3">Share:</span>
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link">
                                    <span class="bi-facebook"></span>
                                </a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link">
                                    <span class="bi-whatsapp"></span>
                                </a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link">
                                    <span class="bi-instagram"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="video-wrap">
            <video autoplay="" loop="" muted="" class="custom-video" poster="">
                <source src="video/Pathaan.mp4" type="video/mp4">
            </video>
        </div>
    </section>

    <section class="about-section section-padding" id="section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb-4 mb-lg-0 d-flex align-items-center">
                    <div class="services-info" style="margin:10%">
                        <h2 class="text-white mb-4">About Watch Better</h2>

                        <p class="text-white"> This cinema experience is the perfect way to enjoy movies.</p>

                        <h6 class="text-white mt-4">Once Experience</h6>

                        <p class="text-white">Well, watching a movie in a totally deserted theater, seated apart from your family, is surely an unusual experience.</p>

                        <h6 class="text-white mt-4">Whole Morning & Night Watch in our cinema </h6>

                        <p class="text-white">Please tell your friends about our website. Thank you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="artists-section section-padding" id="section_3">
        <div class="search-container">
            <form action="Home.php" method="GET">
                <input type="text" name="q" id="search-input" placeholder="Search movies...">
                <button type="submit" id="search-button">Search</button>
            </form>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-4">Latest Releases</h2>
                </div>

                <?php
                // Connect to database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "in_movie";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check if a search query has been submitted
                if (isset($_GET['q'])) {
                    $search_query = $_GET['q'];

                    // Construct and execute the SQL query to search for movies
                    $sql = "SELECT * FROM insertmovie WHERE mname LIKE '%$search_query%'";
                } else {
                    // If no search query is provided, display all movies
                    $sql = "SELECT * FROM insertmovie";
                }

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card movie-card">
                            <img src="<?php echo $row['img']; ?>" class="card-img-top" alt="<?php echo $row['mname']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['mname']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <a href="about.php?name=<?php echo $row['mname']; ?>" class="btn btn-primary">Buy Ticket</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <section class="contact-section section-padding" id="section_6">
        <div class="col-lg-8 col-12 mx-auto">
            <h2 class="text-center mb-4">Any Problem?</h2>

            <nav class="d-flex justify-content-center">
                <div class="nav nav-tabs align-items-baseline justify-content-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-ContactForm-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-ContactForm" type="button" role="tab" aria-controls="nav-ContactForm"
                        aria-selected="false">
                        <h5>System Rating form</h5>
                    </button>
                </div>
            </nav>

            <div class="tab-content shadow-lg mt-5" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-ContactForm" role="tabpanel" aria-labelledby="nav-ContactForm-tab">
                    <form class="custom-form contact-form mb-5 mb-lg-0" action="#" method="post" role="form">
                        <div class="contact-form-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="name" id="contact-name" class="form-control"
                                        placeholder="Full name" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="email" name="email" id="contact-email" pattern="[^ @]*@[^ @]*"
                                        class="form-control" placeholder="Email address" required>
                                </div>
                            </div>

                            <select name="rating" class="form-control" required>
                                <option value="1">1 - Poor</option>
                                <option value="2">2 - Fair</option>
                                <option value="3">3 - Good</option>
                                <option value="4">4 - Very Good</option>
                                <option value="5">5 - Excellent</option>
                            </select><br><br>

                            <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                <button type="submit" class="form-control">Send ratings</button>
                            </div>
                            <?php
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $rating = $_POST['rating'];

                            $conn = mysqli_connect("localhost", "root", "", "in_movie");
                            if ($conn) {
                                // echo "Success";
                            } else {
                                echo "Error";
                            }

                            $sql = "INSERT INTO `ratings` ( `cname`, `email`, `rating`) 
                                        VALUES ( '$name', '$email', '$rating')";

                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                // echo "Data entered";
                            } else {
                                echo "Error";
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="site-footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <h2 class="text-white mb-lg-0">Watch Better</h2>
                </div>
                <div class="col-lg-6 col-12 d-flex justify-content-lg-end align-items-center">
                    <ul class="social-icon d-flex justify-content-lg-end">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link">
                                <span class="bi-whatsapp"></span>
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link">
                                <span class="bi-facebook"></span>
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link">
                                <span class="bi-instagram"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <h5 class="site-footer-title mb-3">Have a question?</h5>
                <p class="text-white d-flex mb-1">
                    <a href="tel: +91 87994 78161" class="site-footer-link">
                        +91 98345 23432
                    </a>
                </p>
                <p class "text-white d-flex">
                    <a href="mailto:bhalodiyazeenal@gmail.com" class="site-footer-link">
                        watchbetter@gmail.com
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-6 col-11 mb-4 mb-lg-0 mb-md-0">
                <h5 class="site-footer-title mb-3">Location</h5>
                <p class="text-white d-flex mt-3 mb-2">
                    Nana Varachha Surat , Gujarat
                </p>
            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 mt-lg-5">
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Terms &amp; Conditions</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Privacy Policy</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Your Feedback</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- T e m p l a t e M o -->

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/click-scroll.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
