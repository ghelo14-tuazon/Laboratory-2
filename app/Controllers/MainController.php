<?php

namespace App\Controllers;
use App\Models\PlaylistMusicModel;
use App\Models\MusicModel;
use App\Models\PlaylistModel;


class MainController extends BaseController
{
    
   
    public function index()
    {
        // List all music
        $musicModel = new MusicModel();
        $data['music'] = $musicModel->findAll();
    
        return view('index', $data); // Correct view path
    }
    
    public function upload()
    {
        // Handle music upload
        if ($this->validate(['music_file' => 'uploaded[music_file]|ext_in[music_file,mp3]'])) {

            $musicModel = new MusicModel();

            $file = $this->request->getFile('music_file');
            $newName = $file->getRandomName();

            $data = [
                'title' => $this->request->getPost('title'),
                'artist' => $this->request->getPost('artist'),
                'genre' => $this->request->getPost('genre'),
                'file_path' => 'uploads/' . $newName,
            ];

            // Insert the data into the 'music' table
            if ($musicModel->insert($data)) {
                // Move the uploaded file to the 'public/uploads' directory
                $file->move(ROOTPATH . 'public/uploads', $newName);
                return redirect()->to(base_url('index'));

            } else {
                // Handle database insertion error
                // You may add specific error handling here
            }
        }

        return view('upload');
    }

    public function createPlaylist()
    {
        // Check if the "name" field exists in the POST data
        $name = $this->request->getPost('name');
        
        if ($name) {
            // Create a new playlist
            $playlistModel = new PlaylistModel();
            
            // Get the music tracks that were selected for the playlist
            $selectedTracks = $this->request->getPost('selected_tracks');
    
            // Use a transaction to ensure data consistency
            $db = \Config\Database::connect();
            $db->transStart();
    
            try {
                // Insert the playlist into the 'playlists' table
                $playlistId = $playlistModel->insert(['name' => $name]);
    
                if ($playlistId) {
                    // If the playlist was created successfully, associate it with selected music tracks
                    if (!empty($selectedTracks)) {
                        $playlist = $playlistModel->find($playlistId);
    
                        // Assuming you have a 'PlaylistMusicModel' representing the pivot table
                        $playlistMusicModel = new PlaylistMusicModel();
                        
                        foreach ($selectedTracks as $musicId) {
                            // Associate the playlist with each selected music track
                            $data = [
                                'playlist_id' => $playlistId,
                                'music_id' => $musicId,
                            ];
                            $playlistMusicModel->insert($data);
                        }
                    }
    
                    // Commit the transaction
                    $db->transCommit();
    
                    // Redirect to the music page or wherever you prefer
                    return redirect()->to(base_url('index'));
                } else {
                    // Handle playlist creation error
                    // You can log or display the errors as needed
                    // Example: log_message('error', 'Failed to create a playlist');
                }
            } catch (\Exception $e) {
                // Handle exceptions and rollback the transaction if an error occurs
                $db->transRollback();
                // Log or display the exception as needed
                // Example: log_message('error', $e->getMessage());
            }
        }
    
        // Retrieve music data to pass to the view
        $musicModel = new MusicModel();
        $data['music'] = $musicModel->findAll(); // Retrieve all music tracks
    
        // Pass $data to the view
        return view('create_playlist', $data);
    }
    
    

    public function addToPlaylist($musicId, $playlistId)
    {
        // Add music to a playlist
        $playlistModel = new PlaylistModel();
        $musicModel = new MusicModel();

        $playlist = $playlistModel->find($playlistId);
        $music = $musicModel->find($musicId);

        if ($playlist && $music) {
            // Add the music to the playlist
            // Implement this logic according to your database structure
            // For example, insert a record in a pivot table.
        }

        return redirect()->to('/music');
    }

    public function removeFromPlaylist($musicId, $playlistId)
    {
        // Remove music from a playlist
        $playlistModel = new PlaylistModel();
        $musicModel = new MusicModel();

        $playlist = $playlistModel->find($playlistId);
        $music = $musicModel->find($musicId);

        if ($playlist && $music) {
            // Remove the music from the playlist
            // Implement this logic according to your database structure
            // For example, delete a record from a pivot table.
        }

        return redirect()->to('/music');
    }

    public function search()
{
    // Get the search term from the form submission
    $searchTerm = $this->request->getPost('search_term');

    // Create an instance of the MusicModel
    $musicModel = new MusicModel();

    // Check if the search term is empty
    if (empty($searchTerm)) {
        // Optionally, you can display a message or redirect to a different page.
        // For example, you can redirect back to the music listing page:
        return redirect()->to(base_url('index'));
    }

    // Call the searchMusic method to perform the modified search
    $searchResults = $musicModel->searchMusicByFirstLetter($searchTerm);

    // Pass the search results to your view for display
    $data = ['music' => $searchResults];

    // Load your view and pass the data
    return view('search_results', $data);
}

    public function playlist()
{
    // Load the playlists from your database and pass them to the view
    $playlistModel = new PlaylistModel();
    $data['playlists'] = $playlistModel->findAll();

    return view('playlist', $data); // Change 'playlist' to your actual view name
}
public function showPlaylist($playlistId)
{
    // Load the playlist details
    $playlistModel = new PlaylistModel();
    $playlist = $playlistModel->find($playlistId);

    if (!$playlist) {
        // Handle the case where the playlist doesn't exist
        return redirect()->to(base_url('playlist'));
    }

    // Assuming you have a method to retrieve all tracks for the playlist from your model
    $musicModel = new MusicModel();
    $playlistTracks = $musicModel->getTracksForPlaylist($playlistId); // Replace with your actual method

    // Pass the data to your view
    $data = [
        'playlist' => $playlist,
        'tracks' => $playlistTracks,
    ];

    // Load your view and pass the data
    return view('show_playlist', $data);
}

public function editPlaylist($playlistId)
{
    // Load the playlist details
    $playlistModel = new PlaylistModel();
    $playlist = $playlistModel->find($playlistId);

    if (!$playlist) {
        // Handle the case where the playlist doesn't exist
        return redirect()->to(base_url('playlist'));
    }

    // Pass playlist data to the view
    $data = [
        'playlist' => $playlist,
    ];

    return view('edit_playlist', $data); // Create a view for editing the playlist
}


public function updatePlaylist($playlistId)
{
    // Check if the "name" field exists in the POST data
    $name = $this->request->getPost('name');
    
    if ($name) {
        // Update the playlist
        $playlistModel = new PlaylistModel();

        if ($playlistModel->update($playlistId, ['name' => $name])) {
            // Redirect to the playlist page or wherever you prefer
            return redirect()->to(base_url('playlist'));
        } else {
            // Handle playlist update error
            // You can log or display the errors as needed
        }
    }

    // If the name is not provided or there's an error, redirect back to the edit page
    return redirect()->to(base_url('playlist/edit/' . $playlistId));
}

public function deletePlaylist($playlistId)
{
    // Load the playlist details
    $playlistModel = new PlaylistModel();
    $playlist = $playlistModel->find($playlistId);

    if (!$playlist) {
        // Handle the case where the playlist doesn't exist
        return redirect()->to(base_url('playlist'));
    }

    // Load the associated playlist tracks (if you have a pivot table)
    // Assuming you have a PlaylistMusicModel representing the pivot table
    $playlistMusicModel = new PlaylistMusicModel();
    $playlistTracks = $playlistMusicModel->where('playlist_id', $playlistId)->findAll();

    // Use a transaction to ensure data consistency
    $db = \Config\Database::connect();
    $db->transStart();

    try {
        // Delete the associated playlist tracks (if you have a pivot table)
        foreach ($playlistTracks as $playlistTrack) {
            $playlistMusicModel->delete($playlistTrack['id']);
        }

        // Delete the playlist itself
        $playlistModel->delete($playlistId);

        // Commit the transaction
        $db->transCommit();

        // After successful deletion, redirect to the playlist page or wherever you prefer
        return redirect()->to(base_url('playlist'));
    } catch (\Exception $e) {
        // Handle exceptions and rollback the transaction if an error occurs
        $db->transRollback();
        // Log or display the exception as needed
        // Example: log_message('error', $e->getMessage());
    }

    // If an error occurred during deletion, redirect back to the playlist page
    return redirect()->to(base_url('playlist'));
}
// In your MainController.php

public function edit_track($playlistId)
{
    // Load the playlist details
    $playlistModel = new PlaylistModel();
    $playlist = $playlistModel->find($playlistId);

    if (!$playlist) {
        // Handle the case where the playlist doesn't exist
        return redirect()->to(base_url('playlist'));
    }

    // Retrieve the associated tracks
    $musicModel = new MusicModel();
    $tracks = $musicModel->findAll(); // You may need to adjust this to fetch available tracks

    // Pass the playlist and tracks data to the view
    $data = [
        'playlist' => $playlist,
        'tracks' => $tracks,
    ];

    // Load the "Edit Tracks" view
    return view('edit_track', $data);
}
// In your update_tracks method
// In your update_tracks method
public function update_tracks($playlistId)
{
    // Retrieve the selected track IDs from the form submission
    $selectedTrackIds = $this->request->getPost('selected_tracks');

    // Load the playlist model instance
    $playlistModel = new PlaylistModel();
    $playlist = $playlistModel->find($playlistId);

    if (!$playlist) {
        // Handle the case where the playlist doesn't exist
        return redirect()->to(base_url('playlist'));
    }

    // Use the PlaylistMusicModel to get associated tracks
    $playlistMusicModel = new PlaylistMusicModel();
    
    // Start a database transaction to ensure data consistency
    $db = \Config\Database::connect();
    $db->transStart();

    try {
        // Remove existing playlist tracks for the playlist
        $playlistMusicModel->where('playlist_id', $playlistId)->delete();

        // Insert the selected tracks into the playlist
        foreach ($selectedTrackIds as $trackId) {
            $data = [
                'playlist_id' => $playlistId,
                'music_id' => $trackId,
            ];
            $playlistMusicModel->insert($data);
        }

        // Commit the transaction
        $db->transCommit();

        // Redirect the user to the playlist view or wherever you prefer
        return redirect()->to(base_url('playlist/show/' . $playlistId));
    } catch (\Exception $e) {
        // Handle exceptions and rollback the transaction if an error occurs
        $db->transRollback();
        // Log or display the exception as needed
        // Example: log_message('error', $e->getMessage());
    }

    // If an error occurred during the update, redirect back to the playlist view
    return redirect()->to(base_url('playlist/show/' . $playlistId));
}
// Add this method to your controller
public function deleteTrack($trackId)
{
    // Load the MusicModel
    $musicModel = new MusicModel();

    // Check if the track exists
    $track = $musicModel->find($trackId);

    if (!$track) {
        // Handle the case where the track doesn't exist
        return redirect()->to(base_url('music'));
    }

    // Delete the track
    if ($musicModel->delete($trackId)) {
        // Track deleted successfully
        return redirect()->to(base_url('index'));
    } else {
        // Handle deletion error
        // You can log or display an error message as needed
    }
}


}
