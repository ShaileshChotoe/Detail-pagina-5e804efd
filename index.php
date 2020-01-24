<?php

$localhost = 'localhost';
$db = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$localhost;dbname=$db;charset=$charset";

try 
{
    $pdo = new PDO($dsn, $user, $pass);
} 
catch (\PDOException $e)
{
    echo 'error connecting to database :( on line : ' . $e->getMessage();
}


$stmt = $pdo->prepare('SELECT * FROM series');
$stmt->execute();

$stmt2 = $pdo->prepare('SELECT * FROM movies');
$stmt2->execute();

$series_array = $stmt->fetchAll(PDO::FETCH_OBJ);
$movies_array = $stmt2->fetchAll(PDO::FETCH_OBJ);


function echoSeries()
{
    global $series_array;
    foreach ($series_array as $key) 
    {
        echo 
        '<tr>' .
            '<td>' . $key->title . '</td>' .
            '<td>' . $key->rating . '</td>' .
            '<td>' . "<a href='series.php?id=$key->id'>details</a>" . '</td>' .
        '</tr>';
    }
}


function echoMovies()
{
    global $movies_array;
    foreach ($movies_array as $key) 
    {
        echo 
        '<tr>' .
            '<td>' . $key->title . '</td>' .
            '<td>' . $key->duur . '</td>' .
            '<td>' . "<a href='films.php?id=$key->volgnummer'>details</a>" . '</td>' .
        '</tr>';
    }
}



?>
<table>
<h3>Series</h3>
<tr>
<th>Titel</th>
<th>Rating</th>
<th>Details</th>
</tr>
<tr>
<?php echoSeries($stmt); ?>
</tr>
</table>

<br>
<br>

<table>
<h3>Films</h3>
<tr>
<th>Titel</th>
<th>Duur</th>
<th>Details</th>
</tr>
<tr>
<?php echoMovies($stmt2); ?>
</tr>
</table>