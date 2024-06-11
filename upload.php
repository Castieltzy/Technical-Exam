<?php
require_once "Connection/connect.php";
require_once 'functions/view.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading of Files</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="CSS/upload.css" rel="stylesheet">
    <!-- Doesn't upload or proceed when inputted wrong file type -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
            var fileInput = document.getElementById("filesToUpload");
            var submitButton = document.getElementById("submitButton");

            function validateFiles() {
                var files = fileInput.files;
                for (var i = 0; i < files.length; i++) {
                    var fileExtension = files[i].name.split('.').pop().toLowerCase();
                    if (allowedFileTypes.indexOf(fileExtension) === -1) {
                        alert('Invalid file type: ' + files[i].name + '. Only JPG, JPEG, PNG, and GIF files are allowed.');
                        submitButton.disabled = true;
                        return;
                    }
                }
                submitButton.disabled = false;
            }

            fileInput.addEventListener("input", validateFiles);
            validateFiles(); // Initial validation in case of any preloaded files
        });
    </script>
</head>

<body>
    <nav>
        <?php include 'nav.html'; ?>
    </nav>

    <div class="container mt-5">
        <h2>Upload Images</h2>
        <form id="uploadForm" action="functions/uploads.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="filesToUpload" class="form-label">Select images to upload:</label>
                <input type="file" class="form-control" name="filesToUpload[]" id="filesToUpload" multiple required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" name="description" id="description" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton" disabled>Upload Images</button>
        </form>

        <h3 class="mt-5">Uploaded Images</h3>
        <div class="row justify-content-left">
            <div class="text-left col-12">
                <p>Click on the image to scroll through the album.</p>
            </div>
            <div class="scroll-container col-12">
                <?php
                $uploads = viewUploads($cn);
                if (!empty($uploads)) {
                    foreach ($uploads as $row) {
                        $caption = $row['description'];
                        $fileNames = explode(',', $row['file_names']);
                        $imageDirectory = "functions/uploads/" . $caption . "/";

                        if (is_dir($imageDirectory)) {
                            $images = [];
                            foreach ($fileNames as $fileName) {
                                $filePath = $imageDirectory . $fileName;
                                if (file_exists($filePath)) {
                                    $images[] = $filePath;
                                }
                            }

                            if (!empty($images)) {
                                shuffle($images);
                                $imagesJson = json_encode($images);

                                echo '<a href="#" class="Upload-image-link" data-bs-toggle="modal" data-bs-target="#uploadModal" data-images=\'' . $imagesJson . '\' data-title="' . htmlspecialchars($caption) . '">';
                                echo '<img class="fixed-size-img card-img-top" style="width: 30rem;" src="' . $images[0] . '" alt="Upload Image">';
                                echo '</a>';
                            }
                        }
                    }
                } else {
                    echo '<p>No uploaded images available. Upload to view.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="mt-3"><?php include 'footer.html'; ?></footer>

    <!-- Modal Structure -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="UploadCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#UploadCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#UploadCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap Integration -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Pic Modal Func -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageLinks = document.querySelectorAll('.Upload-image-link');
            var carouselInner = document.querySelector('.carousel-inner');
            var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
            var modalTitle = document.getElementById('uploadModalLabel');

            imageLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    carouselInner.innerHTML = '';

                    var imageSources = JSON.parse(this.getAttribute('data-images'));

                    imageSources.forEach(function(src, i) {
                        var img = new Image();
                        img.src = src;
                        img.onload = function() {
                            var isLandscape = img.width > img.height;
                            var className = isLandscape ? 'landscape' : 'portrait';
                            var isActive = i === 0 ? 'active' : '';

                            carouselInner.innerHTML += `
                                <div class="carousel-item ${isActive}">
                                    <center><img src="${src}" class="${className}" alt="Upload Image ${i + 1}"></center>
                                </div>
                            `;
                        };
                    });

                    modalTitle.textContent = this.getAttribute('data-title');

                    uploadModal.show();
                });
            });
        });
    </script>
</body>

</html>
