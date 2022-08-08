<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>history_selection</title>
</head>
<body>
    <style>
        <?php include "styles/style.css" ?>
    </style>
    <section class="main">
        <?php include 'navbar.php'; ?>
        <div class="selection_box_main">
            <div class="selection_box">
                <h1>select history</h1>
                <div class="selection_btn">
                    <a href="add_history.php">
                <button class="btn">
                        <div class="image">
                            <img src="img/add.svg" alt="">
                        </div>
                        <div class="text">
                            <h2 style="" >add</h2>
                            <p style="margin: 0px;
    letter-spacing: .8px;
    font-size: .5rem;">history</p>
                        </div>
                    </button></a>
                    <button class="btn">
                        <div class="image">
                            <img src="img/remove.svg" alt="">
                        </div>
                        <div class="text">
                            <h2 style="" >remove</h2>
                            <p style="margin: 0px;
    letter-spacing: .8px;
    font-size: .5rem;">history</p>
                        </div>
                    </button> 
                </div>
            </div>
        </div>
    </section>
</body>
</html>