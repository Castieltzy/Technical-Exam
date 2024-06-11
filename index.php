<?php
require_once "Connection/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Simple Design</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <nav>
        <?php
        include 'nav.html';
        ?>
    </nav>
    <!-- Header -->
    <section>
        <div class="container-fluid header mt-3">
            <div class="position-relative">
                <div class="text pt-5 p-2 p-lg-5 p-md-3">
                    <p class="bold">Lorem Ipsum</p>
                    <p class="bold">Dolor</p>
                    <p class="thin">Sit Amet</p>
                </div>

                <img src="https://static.wixstatic.com/media/3a2b07_5b284046100c48a6a68007f97e2c0e9c~mv2.jpg/v1/fill/w_980,h_575,al_c,q_85,enc_auto/3a2b07_5b284046100c48a6a68007f97e2c0e9c~mv2.jpg" alt="" class="img-fluid w-100 header-img" fetchpriority="high">
                <div class="overlay position-absolute top-0 start-0 h-100"></div>

            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-7 words">
                    <div class="green design">
                        <p>SIMPLE DESIGN</p>
                    </div>
                    <div class="black eam">
                        <p>Exceri facilisi adipiscing an eam
                            <hr class="separator">
                        </p>
                    </div>
                    <div class="lorem">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est.<br><br>
                            Vivamus a tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci. Aenean nec lorem.<br><br>
                            In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.<br><br>
                            Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla. Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien.<br><br>
                            Donec ut est in lectus consequat consequat. Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc porta tristique. Proin nec augue.<br>
                        </p>
                    </div>


                </div>
                <div class="col-lg-5 pics">
                    <div><img class="fPic" src="Assets/gb.png"></div><br>
                    <div><img class="sPic" src="Assets/bg.png"></div>
                </div>

            </div>
        </div>
    </section>

    <footer class="mt-3"><?php include 'footer.html' ?></footer>

    <!-- JS Bootstrap Integration -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Adjust overlay width based on header image width
        function adjustOverlayWidth() {
            const headerImage = document.querySelector('.header-img');
            const overlay = document.querySelector('.overlay');
            const imageWidth = headerImage.clientWidth;
            overlay.style.width = `${imageWidth * 0.29}px`; // Adjust the overlay width to 29% of the image width
        }

        // Initial adjustment
        adjustOverlayWidth();

        // Adjust on window resize
        window.addEventListener('resize', adjustOverlayWidth);
    </script>
</body>

</html>