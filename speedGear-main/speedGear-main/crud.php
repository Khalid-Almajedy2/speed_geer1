<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Company CRUD</title>
</head>
<body>
    <h1>Company CRUD</h1>

    <?php

    include("conn.php");

    // Create operation
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $img = $_POST['img'];

        $query = "INSERT INTO Company (Name, img) VALUES (?, ?)";
        $params = array($name, $img);

        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo "Record created successfully.";
    }

    // Read operation
    $query = "SELECT Id, Name, img FROM Company";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<h2>Company List</h2>";

    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
            </tr>";

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row['Id'] . "</td>
                <td>" . $row['Name'] . "</td>
                <td><img src='data:image/jpeg;base64," . base64_encode($row['img']) . "' width='100' height='100'></td>
            </tr>";
    }

    echo "</table>";

    // Update operation
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $img = $_POST['img'];

        $query = "UPDATE Company SET Name = ?, img = ? WHERE Id = ?";
        $params = array($name, $img, $id);

        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo "Record updated successfully.";
    }

    // Delete operation
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM Company WHERE Id = ?";
        $params = array($id);

        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo "Record deleted successfully.";
    }

    // Closing the connection
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
    ?>

    <h2>Create Company</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="img">Image:</label>
        <input type="text" id="img" name="img" required>

        <input type="submit" name="create" value="Create">
    </form>

    <h2>Update Company</h2>
    <form method="post" action="">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="img">Image:</label>
        <input type="text" id="img" name="img" required>

        <input type="submit" name="update" value="Update">
    </form>

    <h2>Delete Company</h2>
    <form method="post" action="">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>

        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>