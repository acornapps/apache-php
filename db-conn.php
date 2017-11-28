<?php
try{
    

    $mysql_host = 'mysql-db';
    $mysql_db = 'apps-db';
    $mysql_user = 'apps-user';
    $mysql_pwd = 'appsPwd';


    $dbh = new pdo( "mysql:host=$mysql_host:3306;dbname=$mysql_db",
                    $mysql_user,
                    $mysql_pwd,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $result = $dbh->query("show tables");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        echo($row[0]) . "<br />";
    }
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => "Unable to connect: $ex")));
}
?>
