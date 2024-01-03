<?php

    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Logout Procedure
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(sanitize_input($_GET["logout"])==true){
            session_unset();
            session_destroy();
            header("Location: login.php"); /* Redirect browser */
            exit;
        }
    }

function displayUserBookings($bookingsArray) {
    echo "<h2 class='center mb-3'>Meine Buchungen</h2>";
    echo "<table style='border-collapse: collapse; width: 100%;'>
            <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Buchungs ID</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Anreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Abreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Aufenthaltsdauer (Tage)</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Zimmer Kategorie</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Zusatzoptionen</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Gesamtpreis [€]</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Status</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Buchungszeitpunkt</th>
            </tr>";

    foreach ($bookingsArray as $booking) {
        echo "<tr>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_id']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['arrival_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['departure_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['duration_days']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['room']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['options']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['total_price']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_state']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_datetime']."</td>
              </tr>";
    }

    echo "</table>";
}


function displayAllBookings($bookingsArray) {
    echo "<table style='border-collapse: collapse; width: 100%;'>
            <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>User ID</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Username</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Buchungs ID</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Anreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Abreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Aufenthaltsdauer (Tage)</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Zimmer Kategorie</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Zusatzoptionen</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Gesamtpreis [€]</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Status</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Buchungszeitpunkt</th>
            </tr>";

    foreach ($bookingsArray as $booking) {
        echo "<tr>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['user_id']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['username']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_id']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['arrival_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['departure_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['duration_days']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['room']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['options']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['total_price']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_state']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_datetime']."</td>
              </tr>";
    }

    echo "</table>";
}

function displayAllUsers($usersArray) {
    echo "<h2 class='center mb-3'>Liste aller User</h2>";
    echo "<table style='border-collapse: collapse; width: 100%;'>
            <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>User ID</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Anrede</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Vorname</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Nachname</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>E-Mail</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Username</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Administrator</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Aktiv</th>
            </tr>";

    foreach ($usersArray as $user) {
        echo "<tr>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['user_id']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['sex']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['firstname']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['lastname']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['email']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['username']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['admin']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$user['active']."</td>
              </tr>";
    }

    echo "</table>";
}
    
