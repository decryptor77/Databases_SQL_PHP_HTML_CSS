<html>
<body style="background: lightskyblue">
<style>
  h1 {text-align: center;}
  h2 {text-align: center;}
</style>
<h1>Add File</h1>
<h2>Choose File:</h2>
<center>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
        <input name="csv" type="file" id="csv" /> <br>
        <br>
        <input type="submit" name="submit" value="submit" />
    </form>
</center>


<?php


if (isset($_POST["submit"]))
{
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

    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    $file = $_FILES[csv][tmp_name];
    if (($handle = fopen($file, "r")) !== FALSE){
        $counter = 0;
        while (($data = fgetcsv($handle,0,",")) !== FALSE){
            $sql = "INSERT into Netflix(title, director, cast, country, release_year, duration, listed_in)
VALUES ('".addslashes($data[0])."','".addslashes($data[1])."','".addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','".addslashes($data[5])."','".addslashes($data[6])."');";
            sqlsrv_query($conn,$sql);
            $counter = $counter+1;
        }
        $f = file($file);
        $s = count($f);
        $l = $s-$counter;
        echo "$counter relations have been added successfully and $l failed to upload" ;
        fclose($handle);
    }
}

?>

</body>
</html>
