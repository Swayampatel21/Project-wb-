<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .custom-icon {
            height: 60px;
            width: 90px;
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
<?php
    // Connect to database
    $name = $_GET['name'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "in_movie";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM about_movie where mname='$name'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
?>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn custom-btn custom-border-btn text-light" href=""
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['custname']; ?></a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li class="dropdown-header">
                                <h6>
                                    <img src="" width="40px" height="40px" alt="Profile" class="rounded-circle"><?php
                                    //$_SESSION['username'] = $_POST['username'];
                                    //echo "<script>window.location.replace('.php');</script>"; 
                                    ?>
                                </h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                    <i class="bi bi-person"></i>&emsp;
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                    <i class="bi bi-gear"></i>&emsp;
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
                                    <i class="bi bi-question-circle"></i>&emsp;
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i>&emsp;
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section" id="section_1">
        <div class="section-overlay"></div>

        <div class="container d-flex justify-content-left align-items-left">
            <div class="row">
                <div class="col-12 mt-0 mb-1 text-left mb-auto">
                    <h1 class="text-white mb-10"><?php echo $row['mname']; $movieName = $_SESSION['sesName']; ?></h1>
                    <h2 class="text-white mb-5"><img src="upload/star.png" style="height:40px; width:35px;"/>&nbsp;<?php echo $row['rating']; ?>/10</h2>
                    <h5 class="text-white mb-1">Category: <?php echo $row['category']; ?></h5>
                    <h6 class="text-white mb-5">Releasing date: <?php echo $row['releasing_date']; ?></h6>
                    <p class="text-white mb-5 col-5"><b>About Movie: </b><?php echo $row['about_movie'] ?></p>
                    <a class="btn custom-btn smoothscroll" href="time.php?name=<?php echo $row['mname']; ?>">Book Ticket</a>
                </div>

                <div class="col-lg-12 col-12 mt-auto d-flex flex-column flex-lg-row text-center">

                   
                   
                </div>
            </div>
        </div>

        <div class="video-wrap">
            <video autoplay loop class="custom-video" poster="" controls>
    <source src="video/<?php echo $row['trailer'];?>" type="video/mp4">
</video>



        </div>
    </section>
<?php
    }
?>
</body>
</html>
