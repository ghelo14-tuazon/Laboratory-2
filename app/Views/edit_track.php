<!-- app/Views/edit_track.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tracks in Playlist: <?= esc($playlist['name']) ?></title>
    
    <!-- Include Bootstrap 4 via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for styling */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Edit Tracks in Playlist: <?= esc($playlist['name']) ?></h1>
    </header>

    <div class="container mt-4">
        <!-- Back button to redirect to the playlist route -->
        
        
        <!-- "Edit Playlist" section -->
        <h2>Edit Playlist</h2>
        <form method="post" action="<?= base_url('playlist/update_tracks/' . $playlist['id']) ?>">
            <?php if (!empty($tracks)): ?>
                <ul class="list-group">
                    <?php foreach ($tracks as $track): ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="track<?= $track['id'] ?>" name="selected_tracks[]" value="<?= $track['id'] ?>">
                                <label class="form-check-label" for="track<?= $track['id'] ?>">
                                    <?= esc($track['title']) ?> by <?= esc($track['artist']) ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="text-center mt-3">
                <a href="<?= base_url('playlist/show/' . $playlist['id']) ?>" class="btn btn-secondary ml-2">
                    <i class="fas fa-arrow-left"></i> Back to Playlist
                </a>
                    <button type="submit" class="btn btn-primary">Update Playlist</button>
                   
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    No tracks available for this playlist.
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Include Font Awesome for the back arrow icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Include Bootstrap 4 JavaScript via CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
