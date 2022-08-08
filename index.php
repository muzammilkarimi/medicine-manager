<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>med-man</title>
    <link rel="icon" href="img/med_man2.png" />
    <style>
  <?php include "styles/style.css" ?>
  
</style>
</head>

<body onload = "myfunction()">
    <div id="preloader">

    </div>
    <section class="main">
        <div class="welcome">
        <P>﷽ </P>
            <h1>KHALIQUE MEDICAL HALL </h1>
            <p id="time"></p>
            <p id="date"></p>

        </div>
        <!-- this is button section -->
        <div class="btns-main">
            
            <div class="up-btn">
                
                <!-- remove medicine  -->
                <a href="billing.php">
                    <button class="btn">
                        <div class="image">
                            <img src="img/remove.svg" alt="">
                        </div>
                        <div class="text">
                            <h2>Billing</h2>
                            <p>Portal</p>
                        </div>
                    </button>
                </a>
                <!-- add switch -->
                <a href="add-medicine.php">
                    <button class="btn">
                        <div class="image">
                            <img src="img/add.svg" alt="">
                        </div>
                        <div class="text">
                            <h2>Add</h2>
                            <p>Medicine</p>
                        </div>
                    </button>
                </a>
                <!-- show all medicine switch -->
                <a href="show.php">
                <button class="btn">
                    <div class="image">
                        <img src="img/find.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>show</h2>
                        <p>ALL Medicine</p>
                    </div>
                </button>
                </a>
                <!-- history of medicine switch -->
                <a href="history_selection.php">
                <button class="btn">
                    <div class="image">
                        <img src="img/history.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>history</h2>
                        <p>of add/remove</p>
                    </div>
                </button>
                </a>
            </div>
            <!-- empty soon switch -->
            <div class="down-btn">
                <button class="btn">
                    <div class="image">
                        <img src="img/empty.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>empty</h2>
                        <p>Soon Medicine</p>
                    </div>
                </button>
                <!-- see expire medicine btn -->
                <button class="btn">
                    <div class="image">
                        <img src="img/expire.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>Expire</h2>
                        <p>Soon Medicine</p>
                    </div>
                </button>
                <!-- backup data button -->
                <button class="btn">
                    <div class="image">
                        <img src="img/update.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>backup</h2>
                        <p>of All data</p>
                    </div>
                </button>
                <!-- more options button -->
                <button class="btn">
                    <div class="image">
                        <img src="img/more.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>more</h2>
                        <p>option coming soon</p>
                    </div>
                </button>
            </div>
        </div>
        <div class="bottom">
            <p>Develop By <strong> MUZAMMIL AHMAD KARIMI </strong>From <strong> MAKTECH</strong></p>
        </div>
    </section>
    <script>
        let preloader = document.getElementById('preloader');
        function myfunction(){
            preloader.style.display = 'none';
        }
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