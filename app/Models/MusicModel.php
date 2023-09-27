<?php

namespace App\Models;

use CodeIgniter\Model;

class MusicModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'music';
    public function __construct()
    {
        parent::__construct();
    }
 public function addTrackToPlaylist($trackId, $playlistId)
    {
        // Insert a record into the playlist_music table to associate the track with the playlist.
        $data = [
            'track_id' => $trackId,
            'playlist_id' => $playlistId,
        ];

        return $this->insert($data);
    }
    public function getTracksForPlaylist($playlistId)
    {
        // Assuming you have a pivot table named "playlist_music" to associate tracks with playlists
        // Adjust the table and column names based on your database structure

        // Select tracks related to the specified playlist
        $builder = $this->db->table($this->table); // Use the table property

        $builder->select('*');
        $builder->join('playlist_music', 'playlist_music.music_id = music.id');
        $builder->where('playlist_music.playlist_id', $playlistId);

        return $builder->get()->getResultArray();
    }
    public function searchMusic($searchTerm)
    {
        // Perform a database query to search for music based on the search term
        $query = $this->table('music')->like('title', $searchTerm)->orWhere('artist', $searchTerm)->get();

        // Check if any results were found
        if ($query->getNumRows() > 0) {
            // Return the results as an array
            return $query->getResultArray();
        } else {
            // No music found for the search term
            return [];
        }
    }
    public function searchMusicByFirstLetter($searchTerm)
{
    // Assuming you have a 'music' table with a 'title' column
    // Retrieve music where the first letter of the title matches the search term
    $query = $this->db->table('music')
                     ->like('title', $searchTerm, 'after')
                     ->get();

    // Return the search results as an array
    return $query->getResultArray();
}

  
 
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['title', 'artist', 'genre', 'file_path'];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
