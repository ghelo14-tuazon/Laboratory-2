<!-- upload.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Music</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div style="max-width: 500px; margin: 0 auto; padding: 20px;">
        <h1 style="text-align: center; margin-bottom: 20px;">Upload Music</h1>
        
        <!-- "Back" button in the left corner -->
        <a href="<?= base_url('index') ?>" class="btn btn-secondary mb-3">Back</a>

        <?php if (isset($validation)): ?>
            <div style="background-color: #ffcccc; color: #ff0000; padding: 10px; border: 1px solid #ff0000;">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/upload" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" style="font-weight: bold;">Title:</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>

            <div class="mb-3">
                <label for="artist" style="font-weight: bold;">Artist:</label>
                <input type="text" class="form-control" name="artist" id="artist">
            </div>

            <div class="mb-3">
                <label for="genre" style="font-weight: bold;">Genre:</label>
                <input type="text" class="form-control" name="genre" id="genre">
            </div>

            <div class="mb-3">
                <label for="music_file" style="font-weight: bold;">Music File:</label>
                <input type="file" class="form-control" name="music_file" id="music_file">
            </div>

            <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto;">Upload</button>
        </form>
    </div>
</body>
</html>
