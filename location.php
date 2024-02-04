<!DOCTYPE html>
<html>
<head>
    <title>Location Scan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            margin: 0;
        }

        .container {
            max-width: 50%;
            margin: 0 auto;
            padding: 80px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container1 {
            background: transparent;
            background-color: whitesmoke;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 18px;
        }

        .zoom-image {
            height: 50%;
            width: 50%;
            animation: zoomInOut 3s infinite alternate;
        }

        @keyframes zoomInOut {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }

        .track-location {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            color: #333;
        }

    </style>
</head>
<body>
    <header>
        <h1>Scan for the Location</h1>
    </header>
    <div class="container" align="center">
        <img class="zoom-image" src="location1.png" alt="Location Image">
        <br/><br/><br/>
        <h1 class="container1"><a href="loc.php" class="track-location">or<br/> Track location</a></h1>
    </div>
</body>
</html>
