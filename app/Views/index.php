<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Music Player</h1>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <a href="upload" class="btn btn-primary">Upload Music</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="create-playlist" class="btn btn-success">Create Playlist</a>
                <a href="playlist" class="btn btn-info">Show Playlist</a>
            </div>
        </div>

        <!-- Add the search form here -->
        <form method="post" action="<?= base_url('music/search') ?>" class="mt-4">
            <div class="form-group">
                <label for="search_term">Search:</label>
                <input type="text" name="search_term" id="search_term" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (!empty($music)): ?>
            <ul class="list-group mt-4">
                <?php foreach ($music as $song): ?>
                    <li class="list-group-item">
                        <h5><?= $song['title'] ?></h5>
                        <p>Artist: <?= $song['artist'] ?></p>
                        
                        <!-- Add the audio element here with Bootstrap classes -->
                        <div class="mb-3">
                            <audio controls class="w-100 audio-player">
                                <source src="<?= $song['file_path'] ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                
                        <!-- Move the delete button to the bottom-right corner under the track -->
                        <div class="text-right">
                            <form method="post" action="<?= base_url('music/delete/' . $song['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-md">Delete</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="mt-4">No music available.</p>
        <?php endif; ?>

    </div>

    <!-- Add Bootstrap JS scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to control audio playback -->
   <!-- JavaScript to control audio playback -->
<script>
    const audioPlayers = document.querySelectorAll('.audio-player');

    audioPlayers.forEach(player => {
        player.addEventListener('play', function () {
            // Pause all other players when one is played
            audioPlayers.forEach(otherPlayer => {
                if (otherPlayer !== player && !otherPlayer.paused) {
                    otherPlayer.pause();
                    otherPlayer.currentTime = 0; // Set the current time to 0
                }
            });
        });
    });
</script>

</body>
</html>
