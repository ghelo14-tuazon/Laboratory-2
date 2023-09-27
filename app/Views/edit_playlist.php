<!-- app/Views/edit_playlist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Playlist</title>
    
    <!-- Include Bootstrap 4 via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Edit Playlist</h1>
    </header>

    <div class="container mt-4">
        <h2>Edit Playlist Name</h2>
        <form action="<?= base_url('playlist/update/' . $playlist['id']) ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $playlist['name'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <hr>

    </div>

    <!-- Include Bootstrap 4 JavaScript via CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
