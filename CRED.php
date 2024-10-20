<?php
    // Database connection parameters
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "dbs";

    // Establish database connection
    $connection = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve username and password from the form
        $enteredUsername = $_POST["name"];
        $enteredNumber = $_POST["number"];
        $action = $_POST["action"];

        switch ($action) {
            case "Insert":
                $insertQuery = "INSERT INTO college VALUES ('$enteredUsername', '$enteredNumber')";
                $result = mysqli_query($connection, $insertQuery);
                if($result)
                {
                    echo "<p>Data inserted successfully!</p>";
                }
                else
                {
                    echo "<p>Data insertion Unsuccessfull.</p>";
                }break;
    
            case "Update":
                $updateQuery = "UPDATE college SET p_no = '$enteredNumber' WHERE name = '$enteredUsername'";
                $result = mysqli_query($connection, $updateQuery);
                if($result)
                {
                    echo "<p>Data updated successfully!</p>";
                }
                else
                {
                    echo "<p>Data updation Unsuccessfull.</p>";
                }break;    
            case "Delete":
                $deleteQuery = "DELETE FROM college WHERE p_no = $enteredNumber";
                $result = mysqli_query($connection, $deleteQuery);
                if($result)
                {
                    echo "<p>Data deleted successfully!</p>";
                }
                else
                {
                    echo "<p>Data deletion Unsuccessfull.</p>";
                }break;
            case "Show":
                $selectQuery = "SELECT * FROM college";
                $result = mysqli_query($connection, $selectQuery);
                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Name</th><th>Phone Number</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['p_no'] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No data found.</p>";
                }
                break;
            default:
                echo "<p>Unknown action.</p>";
                break;
        }
    }        

    
    // Close connection
    mysqli_close($connection);
    ?>