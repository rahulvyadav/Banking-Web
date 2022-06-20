<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
        body{
            background-color: rgb(202, 219, 236);
        }
        h2{
            text-align: center;
            font-size: 50px;
        }
        table,tr,td,th{
            border: 1px solid black ;
        }
        table{
            border-collapse: collapse;
            width: 30%;
            margin-left: auto;
            margin-right: auto;
        }
        td{
            text-align: center;
        }
        tr:hover{background-color: blanchedalmond;}
        th{
            background-color: rgb(227, 156, 63);
        }
    </style>
</head>
<body>
  <?php  
        
        include 'header.php';
        $current_uid = 3;

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
        $sql = "SELECT * FROM users WHERE user_id=$current_uid";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h3>". $row["name"] ."</h3><h3>Current Balance: $". $row["current_balance"] ."</h3>";
        }
        }
    ?>
    <h2>Transaction History</h2>
    <table id="my_table">
        <tr>
            <th>Transaction ID</th>
            <th>From User ID</th>
            <th>To User ID</th>
            <th>Amount</th>
            <th>Time</th>
        </tr>
        
        <?php

          $sql = "SELECT * FROM transactions";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              if($row["from_uid"] == $current_uid || $row["to_uid"] == $current_uid) {
                echo "<tr><td>" . $row["transaction_id"]. "</td><td>" . $row["from_uid"]. "</td><td>" . $row["to_uid"]. "</td><td>$" . $row["amount"]. "</td><td> " . $row["time"]. "</td></tr>";
              } else {
                continue;
            }
            }
          } else {
            echo "<tr><td>No records found!</td></tr>";
          }
          $conn->close();
        ?>      
  </table>


</body>
</html>