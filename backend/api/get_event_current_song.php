<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

// Extract, validate and sanitize the id.
$event_id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;

$songs = [];
//$sql = "SELECT songs.*, queuedSongs.popularity as qpop, queuedSongs.playability, order_num FROM new_songs as songs, queuedSongs, events where event_id = {$event_id} and order_num = events.current_song and queuedSongs.song_id = songs.song_id and queuedSongs.platform = songs.platform";
$sql = "SELECT songs.*, queuedSongs.popularity as qpop, queuedSongs.playability, order_num FROM new_songs as songs, queuedSongs, events where events.event_id = {$event_id} and events.event_id = queuedSongs.event_id and order_num = events.current_song and queuedSongs.song_id = songs.song_id and queuedSongs.platform = songs.platform";
if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $songs[$i]['song_id'] = $row['song_id'];
    $songs[$i]['platform'] = $row['platform'];
    $songs[$i]['title'] = $row['title'];
    $songs[$i]['artist'] = $row['artist'];
    $songs[$i]['artwork'] = $row['artwork'];
    //$songs[$i]['genre'] = $row['genre'];
    $songs[$i]['duration'] = $row['duration'];
    $songs[$i]['order_num'] = $row['order_num'];
    $songs[$i]['popularity'] = $row['qpop'];
    $songs[$i]['playability'] = $row['playability'];
    //$songs[$i]['track_id'] = $row['track_id'];
    // $songs[$i]['danceability'] = $row['danceability'];
    // $songs[$i]['energy'] = $row['energy'];
    // $songs[$i]['instrumental'] = $row['instrumental'];
    // $songs[$i]['music_key'] = $row['music_key'];
    // $songs[$i]['liveness'] = $row['loudness'];
    // $songs[$i]['loudness'] = $row['loudness'];
    // $songs[$i]['mode'] = $row['mode'];
    // $songs[$i]['speechiness'] = $row['speechiness'];
    // $songs[$i]['tempo'] = $row['tempo'];
    // $songs[$i]['time_signature'] = $row['time_signature'];
    // $songs[$i]['valence'] = $row['valence'];
    // $songs[$i]['order_num'] = $row['order_num'];
    $i++;
  }

  
  echo json_encode($songs);
  
  http_response_code(200);
  
  
}
else
{
  http_response_code(404);
}
?>