<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All tickets</title>
</head>
<body>

    <?php
        require_once("dbaccess.php");
        $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
        $sql = "SELECT * FROM tickets";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($ticket_id, $file_path, $comment, $user_id);

    ?>
    
    <h1>Tickets</h1>
    <table border="1">
        <th>Ticket Id</th>
        <th>User Id</th>
        <th>Comment</th>
        <th>Picture</th>
        <?php
        while($stmt->fetch()){
            echo "<tr>";
            echo "<td>$ticket_id</td>";
            echo "<td>$user_id</td>";
            echo "<td>$comment</td>";
            echo "<td><img src='$file_path' height='600' /></td>";
            echo "<td>$file_path</td>";
            echo "</tr>";
        }

    ?>
    </table>



</body>
</html>