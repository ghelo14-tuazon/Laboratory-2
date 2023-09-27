<!-- app/Views/show_playlist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $playlist['name'] ?> Playlist</title>

    <!-- Include Bootstrap 4 via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1><?= $playlist['name'] ?> Playlist</h1>
    </header>

    <div class="container mt-5">
        <!-- "Edit Playlist" section -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="<?= base_url('playlist') ?>" class="btn btn-secondary">Back </a>
            </div>
            <div class="col-md-6 mb-3 text-md-right"> <!-- Align right for medium and larger screens -->
                <a href="<?= base_url('playlists/edit/' . $playlist['id']) ?>" class="btn btn-primary">Edit Playlist</a>
            </div>
        </div>

        <!-- Display the audio tracks for the playlist -->
        <?php if (!empty($tracks)): ?>
            <ul class="list-group">
                <?php foreach ($tracks as $track): ?>
                    <li class="list-group-item">
                        <h5 class="mb-1"><?= $track['title'] ?></h5>
                        <p class="mb-1">Artist: <?= $track['artist'] ?></p>
                        
                        <!-- Add the audio element here with Bootstrap classes -->
                        <audio controls class="w-100">
                            <source src="<?= base_url($track['file_path']) ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        
                        <!-- Add the "Edit" button/link for this track -->
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info mt-4">
                No tracks available for this playlist.
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap 4 JavaScript via CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add this JavaScript code to the bottom of your show_playlist.php file, just before the closing </body> tag. -->
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
