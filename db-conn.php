<?php

$mysql_host = "mysql-db:3306";
$dbname = 'apps-db';
$username = 'apps-user';
$password = 'appsPwd';

$table = 'MyGuests';
try {

    // Create connection
    $conn = new mysqli($mysql_host,$username,$password,$dbname );
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SHOW TABLES LIKE '".$table."'");
    $exist = ( $result->num_rows > 0 );


    if ($exist) {    
        echo "Table exists<br>";
        if ($conn->query("DROP TABLE ".$table) === TRUE) {
            echo "Table MyGuests deleted successfully <br>";
            /* commit transaction */
            if (!$conn->commit()) {
                print("Transaction commit failed\n");
                exit();
            }            
        } else {
            echo "Error deleted table: ";
        }            
    }

    $sql = "CREATE TABLE $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error."<br>";
    }

    $sql_insert = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $result1 = $conn->query("SELECT * FROM '".$table."'");
    $row_count = $result1->num_rows;
 
    echo $table . " ROW COUNT " . $row_count . "<br />";

    $conn->close();

}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

?>
