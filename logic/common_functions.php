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

function displayBookings($bookingsArray) {
    echo "<table style='border-collapse: collapse; width: 100%;'>
            <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Buchungs ID</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Anreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Abreisedatum</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Aufenthaltsdauer (Tage)</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Gesamtpreis</th>
            </tr>";

    foreach ($bookingsArray as $booking) {
        echo "<tr>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['booking_id']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['arrival_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['departure_date']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['duration_days']."</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>".$booking['total_price']."</td>
              </tr>";
    }

    echo "</table>";
}
    
