<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        .nav {
            display: flex;
            width: 57%;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }
        <?php include "styles/navbar.css" ?>
  

    </style>
</head>

<body>
    <div class="nav">

        <a href="index.php" style="text-decoration: none;">
            <button class="back_btn" style="margin-left: 20px;">
                <div class="image">
                    <img src="img/back.svg" alt="">
                </div>
                <div class="text">
                    <h2>back</h2>
                    <p>To home page</p>
                </div>
            </button>
        </a>
        <div class="clock" style="text-align: center;">
            <p id="time"></p>
            <p id="date"></p>
        </div>
    </div>
    <script>
        setInterval(datetime, 1000);
        function datetime() {
            let tm = new Date();
            let hour = tm.getHours();
            let min = tm.getMinutes();
            let sec = tm.getSeconds();
            am_pm = "AM";
            if (hour > 12) {
                hour -= 12;
                am_pm = "PM";
            }
            if (hour == 0) {
                hour = 12;
                am_pm = "AM";
            }
            hour = hour < 10 ? "0" + hour : hour;
            min = min < 10 ? "0" + min : min;
            sec = sec < 10 ? "0" + sec : sec;
            let currenttime = hour + ":" + min + ":" + sec + " " + am_pm;
            document.getElementById("time").innerHTML = currenttime;



            // this is for date 
            let dt = new Date();
            document.getElementById("date").innerHTML = dt.toDateString();
        }

    </script>
</body>

</html>