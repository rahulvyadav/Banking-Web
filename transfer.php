<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <script>
        // Get the modal
       window.onload=function(){

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const result = urlParams.get("result");

        if(result == "success") {
          document.getElementById("result_message").innerHTML = "<h1>Money successfully transfered!</h1>";
        } else if(result == "failure") {
          document.getElementById("result_message").innerHTML = "<h1>Some error occured!</h1>";
        }

        var modal = document.getElementById("myModal");
        
        // Get the button that opens the modal
        var btn = document.getElementsByClassName("transfer_btn");
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks the button, open the modal 
    console.log(btn)
    for(let i=0;i<btn.length;i++){
        btn[i].onclick = function() {
          modal.style.display = "block";
          console.log(i);
          var table = document.getElementById("my_table")
          document.getElementById("to_uid").setAttribute("value", document.getElementById("my_table").rows[i+1].cells[0].innerHTML)
          document.getElementById("transfer_to").setAttribute("value", document.getElementById("my_table").rows[i+1].cells[1].innerHTML);
          document.getElementById("transfer_to").setAttribute("disabled", "true");
        }
    
    }
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
    }
        </script>


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


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #fffrg; /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
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

  ?>

  <div id="result_message"></div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content" style="background-color:#73DD59">
          <span class="close">&times;</span>
          <h4 style="text-align: center; font-size: 25px">Send money</h4>
          <label style=" font-size: 20px">Transfer to</label>
          <input type="text" id="transfer_to">
          <br />
          <br />
          <form name="money_transfer" action="send_money.php" method="POST">
            <input type="hidden" id="from_uid" name="from_uid" value="<?php echo htmlspecialchars($current_uid); ?>" />
            <input type="hidden" id="to_uid" name="to_uid" />
            <label style=" font-size: 20px">Amount :</label>
            <input type="number" name="tranfer_amount" />
            <br>
            <br>
            <button type="submit">Transfer</button> &nbsp;&nbsp;
            <button type="cancel">Cancel</button>
          </form>
          
        </div>
      
      </div>
    <?php
      $sql = "SELECT * FROM users WHERE user_id=$current_uid";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<h3>". $row["name"] ."</h3><h3>Current Balance: $". $row["current_balance"] ."</h3>";
        }
      }
    ?>
    <h2>Transfer Money</h2>
    <table id="my_table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Balance</th>
            <th>Opertion</th>
        </tr>
        
        <?php

          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              if($row["user_id"] == $current_uid) {
                continue;
              } else {
                echo "<tr><td>" . $row["user_id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>$" . $row["current_balance"]. "</td><td><button class='transfer_btn'>Transfer</button></td></tr>";
              }
            }
          } else {
            echo "0 results";
          }
          $conn->close();
        ?>      
  </table>


</body>
</html>