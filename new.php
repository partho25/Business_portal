<?php
    date_default_timezone_set('Asia/Dhaka');
    $conn = mysqli_connect("localhost", "root", "", "partha");

    if ($_POST) {
        $date = $_POST['date'];
        $date = date("Y-m-d", strtotime($date));  
        $name = $_POST['name'];
        $deposit = $_POST['deposit'];

        $sql = "SELECT redecual FROM account ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $previous_redecual = $row['redecual'];
            }
        } else {
            echo "0 results";
        }
        $total = $deposit + $previous_redecual;
        $sold = $_POST['sold'];
        $redecual = $total - $sold;

        $sql = "INSERT INTO account(date, name, deposit, total, sold, redecual) VALUES ('$date', '$name', $deposit, $total, $sold, $redecual)";
        if ($conn->query($sql)) {
            header('Location:index.php');
        }
    }
    ?>