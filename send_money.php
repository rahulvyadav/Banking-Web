<?php

$to_uid = $_POST['to_uid'];
$from_uid = $_POST['from_uid'];
$transfer_amount = $_POST['tranfer_amount'];

$servername = "localhost";
$username = "root";
$password = "";
$db = "sparks_bank_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$old_balance = 0;
$result = "failure";
$sql = "SELECT current_balance FROM users WHERE user_id=$from_uid";
$result = $conn->query($sql);
if ($result) {
    while($row = $result->fetch_row()) {
        $old_balance = $row[0];
    }
}
$new_balance = $old_balance - $transfer_amount;
if($new_balance > 0) {
        $sql = "UPDATE users SET current_balance=$new_balance WHERE user_id=$from_uid";
        $result =  $conn->query($sql);
        if($result) {
            $sql = "SELECT current_balance FROM users WHERE user_id=$to_uid";
            $result = $conn->query($sql);
            if ($result) {
                while($row = $result->fetch_row()) {
                    $old_balance = $row[0];
                }
                $new_balance = $old_balance + $transfer_amount;
                $sql = "UPDATE users SET current_balance = $new_balance WHERE user_id= $to_uid";
                $result =  $conn->query($sql);
                if ($result) {
                    $sql = "INSERT INTO transactions (to_uid, from_uid, amount) VALUES ($to_uid, $from_uid, $transfer_amount)";
                    $result = $conn->query($sql);
                    if($result) {
                        $result = "success";
                    } else {
                        $result = "failure";
                    }
                } else {
                $result = "failure";
                }
            } else {

                $result = "failure";
            }
        } else {
            $result = "failure";
        }
} else {
    $result = "failure";
}


$conn->close();

header("Location: http://localhost/Banking%20Web/transfer.php?result=$result");
die();
?>
