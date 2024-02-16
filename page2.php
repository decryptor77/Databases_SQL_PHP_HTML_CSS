<html>
<body style="background: lightskyblue">
<style>
    h1 {text-align: center;}
    h2 {text-align: center;}
    h5 {text-align: center;}
</style>
<h1>New Movie</h1>
<h2>Fill movie details:</h2>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <table style=": 1000px">
        <tr>
            <td>Title: </td>
            <td><input type = "text" name="TITLE" size="150" required></td>
        </tr>
        <tr>
            <td>Director: </td>
            <td><input type = "text" name="DIRECTOR" size="150" required></td>
        </tr>
        <tr>
            <td>Cast: </td>
            <td><input type = "text" name="CAST" size="150" ></td>
        </tr>
        <tr>
            <td>Country: </td>
            <td><input type = "text" name="COUNTRY" size="150" required></td>
        </tr>
        <tr>
            <td>Release Year: </td>
            <td><input type = "number" name="RELEASE_YEAR" min="1900" max="2020" step="1" ></td>
        </tr>
        <tr>
            <td>Duration: </td>
            <td><input type="range" name="DURATION" min="20" max="200" step="1"></td>
        </tr>
        <tr>
            <td>Listed in: </td>
            <td><input type = "text" name="LISTED_IN" size="150"></td>
        </tr>
    </table>
    <center><button name="submit" type="submit" value="Send"> Submit Movie Info</button></center>
    <br>
    <center><button type="reset" value="Clear"> Reset</button></center>
</form>


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
// In case of success
if (isset($_POST["submit"]))
{
    // Inserting data into Netflix table
    $sql = "INSERT INTO Netflix(title,director,cast,country,release_year,duration,listed_in)
    VALUES('".$_POST['TITLE']."','".$_POST['DIRECTOR']."','".$_POST['CAST']."','".$_POST['COUNTRY']."','".$_POST['RELEASE_YEAR']."','".$_POST['DURATION']."','".$_POST['LISTED_IN']."');";
    $result = sqlsrv_query($conn, $sql);
    // In case of failure
    if (!$result)
    {
        die("Couldn't add the Movie.<br>");
    }
    echo "The Movie has been added to the database.<br><br>";
}
?>
</body>
</html>
