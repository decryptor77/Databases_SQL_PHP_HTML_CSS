<html>
<div></div>
<body style="background-color:powderblue;">
<style>
h1 {text-align: center;}
h2 {text-align: center;}
    img {
        width: 30%;
        height: 30%;
    }
</style>
<h1>Netflix</h1>
<h2>Providing all the Movie Data you need</h2>
<center>
<img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Netflix_icon.svg" alt="netflix">
</center>
<br>
<br>
<center>
    <a href="page2.php" target="_blank">add a new movie </a>
</center>
<br>
<center>
    <a href="page1.php" target="value">add a new file </a>
</center>
<br>
<br>
<center>
<h1>Longest non US movies with a single director by year</h1>
</center>
<?php
//Connecting to the database
$server = "tcp:techniondbcourse01.database.windows.net";            
$user = "noor0nashef";
$pass = "Qwerty12!";
$database = "noor0nashef";
$c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect($server, $c);
if($conn === false)
{
    echo "error";
    die(print_r(sqlsrv_errors(), true));
}
//echo "connected to DB"; //debug
$sql = "SELECT N1.title, N1.duration, N1.release_year
FROM Netflix N1
WHERE N1.country NOT LIKE '%United%States%'
  AND N1.director NOT LIKE '%,%'
  AND N1.duration >= ALL (
    SELECT N2.duration
    FROM Netflix N2
    WHERE N1.release_year = N2.release_year
      AND N2.country NOT LIKE '%United%States%'
      AND N2.director NOT LIKE '%,%')
ORDER BY N1.release_year DESC;";

$result = sqlsrv_query($conn, $sql);
echo "<center>", "<table border=\"1\"style=\"width:50%\">";
echo"<tr><th>Year</th><th>Title</th><th>Duration</th></tr>";

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
    $Year = $row['release_year'];
    $Title = $row['title'];
    $Duration = $row['duration'];
    echo "<tr><td>$Year</td><td> $Title</td><td>$Duration</td></tr>";
}
echo "</table>", "<center>";
?>
</body>
</html>
