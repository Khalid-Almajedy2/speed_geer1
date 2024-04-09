<!DOCTYPE html>
<html>
<head>
    <title>Company Data</title>
</head>
<body>
    <h1>Company Data</h1>

    <?php
    // // Database connection settings
    // $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    // $connectionOptions = array(
    //     "Database" => "Speed_Geer",
    //     "Uid" => "your_username",
    //     "PWD" => "your_password"
    // );

    // // Database connection settings
    // $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    // $connectionOptions = array( "Database" => "Speed_Geer", "CharacterSet" => "UTF-8");

    // // Establishing the connection
    // $conn = sqlsrv_connect($serverName, $connectionOptions);

    // if ($conn === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }

    // // Fetching data from the database
    // $query = "SELECT Id, Name, img FROM Company";
    // $result = sqlsrv_query($conn, $query);

    // if ($result === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }

    include("includes/lib.php");

    $all = select("SELECT * From company");

    // Displaying the data in a table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
            </tr>";

            foreach($all as $row){
        echo "<tr>
                <td>" . $row['Id'] . "</td>
                <td>" . $row['Name'] . "</td>
                <td><img src='data:image/jpeg;base64," . base64_encode($row['img']) . "' width='100' height='100'></td>
                
            </tr>";
    }
    // <td><img src='" . $row['img'] . "' width='100' height='100'></td>
    echo "</table>";

    ?>

</body>
</html>