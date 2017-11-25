<!DOCTYPE html>
<html>

<head>
    <title>Match Me</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.2.1.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        img {
            display: block;
            margin: auto;
            height: 100vh;


        }

        #answer {
            z-index: 1;
            bottom: 0;
            left: 0px;
            right: 0px;
            position: fixed;

        }

        #answer .y {
           
            background-color: greenyellow;
            text-align: center;
            padding: 5%;
        }

        #answer .n {
          
            background-color: red;
     padding: 5%;
            text-align: center;
        }

    </style>

</head>

<?php

$_SESSION['test'] = 1;

?>

<body>



    <section id="1">
        <img src="Artboard 1.png" alt="Smiley face">

    </section>
    <section id="2">
        <img src="Artboard 2.png" alt="Smiley face">

    </section>
    <section id="3">
        <img src="Artboard 3.png" alt="Smiley face">

    </section>
    <section id="4">
        <img src="Artboard 4.png" alt="Smiley face">

    </section>
    <div id="answer">
        <h1 class="y">YES</h1>
        <h1 class="n">NO</h1>

    </div>

    <script>
        var count = 0;

        $("#2").fadeOut(0);
        $("#3").fadeOut(0);
        $("#4").fadeOut(0);



        $(".y").click(function() {
            count += 1;
            console.log(count);

            if (count === 1) {

                $("#1").fadeOut(0);
                $("#2").fadeIn(0);
            } else if (count === 2) {

                $("#2").fadeOut(0);
                $("#3").fadeIn(0);
            } else if (count === 3) {
                $("#3").fadeOut(0);
                $("#4").fadeIn(0);


            } else if (count === 4) {

                $(location).attr('href', '../dashboard.php');


            }

        });




        $(".n").click(function() {
            count += 1;

            console.log(count);

            if (count === 1) {

                $("#1").fadeOut(0);
                $("#2").fadeIn(0);
            } else if (count === 2) {
                $("#2").fadeOut(0);
                $("#3").fadeIn(0);
            } else if (count === 3) {
                $("#3").fadeOut(0);
                $("#4").fadeIn(0);


            } else if (count === 4) {

                $(location).attr('href', '../dashboard.php');


            }



        });

    </script>

</body>

</html>
