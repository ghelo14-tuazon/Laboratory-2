<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Playlist</title>
    <!-- Bootstrap CSS via CDN -->
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
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #555e66;
            border-color: #555e66;
        }
        .form-check-label {
            display: block;
            padding-left: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create Playlist</h1>
        <!-- "Edit Playlist" section -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="<?= base_url('index') ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- Your playlist creation form goes here -->
        <form method="post" action="create-playlist">
            <!-- Add form fields for playlist details -->
            <div class="form-group">
                <label for="name">Playlist Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <!-- List of available audio tracks (songs) with checkboxes -->
            <h2>Select Audio Tracks</h2>
            <?php if (!empty($music)): ?>
                <?php foreach ($music as $song): ?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="selected_tracks[]" id="track<?= $song['id'] ?>" value="<?= $song['id'] ?>">
                        <label class="form-check-label" for="track<?= $song['id'] ?>">
                            <?= $song['title'] ?> - <?= $song['artist'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No music available.</p>
            <?php endif; ?>

            <!-- Add other playlist-related form fields as needed -->

            <button type="submit" class="btn btn-primary mt-3">Create Playlist</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if needed) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
