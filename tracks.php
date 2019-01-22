<?php
  $pdo = new PDO('sqlite:chinook.db');
  $sql = "
    SELECT 
     g.Name AS genre
    ,t.Name AS track
    ,al.Title AS album
    ,ar.Name AS artist
    ,t.UnitPrice AS price

    FROM tracks t
    INNER JOIN genres g ON t.GenreId = g.GenreId
    INNER JOIN albums al ON t.AlbumId = al.AlbumId
    INNER JOIN artists ar ON al.ArtistId = ar.ArtistId

  ";

  if ( isset($_GET['genre']) ) {
    $sql = $sql . " WHERE g.Name LIKE '" . $_GET['genre'] . "'";
  }
 
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $details = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Assignment 1</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
  <table class="table">
    <tr>
      <th>Genre</th>
      <th>Track</th>
      <th>Artist</th>
      <th>Album</th>
      <th>Price</th>
    </tr>
    <?php foreach($details as $detail) : ?>
      <tr>
        <td>
          <?php echo $detail->genre ?>
        </td>
         <td>
          <?php echo $detail->track ?>
        </td>
        <td>
          <?php echo $detail->artist ?>
        </td>
        <td>
          <?php echo $detail->album ?>
        </td>
        <td>
          <?php echo $detail->price ?>
        </td>
      </tr>
    <?php endforeach ?>
    <?php if(count($details) === 0) : ?>
      <tr>
        <td colspan="4">No tracks found</td>
      </tr>
    <?php endif ?>
  </table>
</body>
</html>