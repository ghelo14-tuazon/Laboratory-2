<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for alignment and styling */
        body {
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #555e66;
            border-color: #555e66;
        }
        .list-group-item {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Search Results</h1>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="<?= base_url('index') ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <?php if (!empty($music)): ?>
            <ul class="list-group">
                <?php foreach ($music as $song): ?>
                    <li class="list-group-item">
                        <h5><?= $song['title'] ?></h5>
                        <p>Artist: <?= $song['artist'] ?></p>
                        
                        <!-- Add the audio element here with Bootstrap classes -->
                        <div class="mb-3">
                            <audio controls class="w-100">
                                <!-- Use base_url() to generate the correct audio file path -->
                                <source src="<?= base_url($song['file_path']) ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="mt-4">No music found for the search term.</p>
        <?php endif; ?>
    </div>

    <!-- Add Bootstrap JS scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Get all audio elements on the page
    const audioElements = document.querySelectorAll('audio');

    // Add an event listener to each audio element
    audioElements.forEach((audioElement) => {
        // Pause all other audio elements when one is played
        audioElement.addEventListener('play', () => {
            audioElements.forEach((otherAudio) => {
                if (otherAudio !== audioElement && !otherAudio.paused) {
                    otherAudio.pause();
                    otherAudio.currentTime = 0;
                }
            });
        });
    });

    </script>
</body>
</html>
