<!-- app/Views/playlist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlists</title>
    
    <!-- Include Bootstrap 4 via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>My Playlists</h1>
        
    </header>
    <div class="container mt-5">
        <!-- "Edit Playlist" section -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="<?= base_url('index') ?>" class="btn btn-secondary">Back</a>
            </div>
    <div class="container mt-4">
        <!-- Display the user's playlists as a table -->
        <?php if (!empty($playlists)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($playlists as $playlist): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('playlist/show/' . $playlist['id']) ?>"><?= $playlist['name'] ?></a>
                            </td>
                            <td>
                                <a href="<?= base_url('playlist/edit/' . $playlist['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= base_url('playlist/delete/' . $playlist['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="mt-4">You have no playlists.</p>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap 4 JavaScript via CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
