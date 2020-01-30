<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
      die("Connection failed: ".mysqli_connect_error());
  }

  $sql = "select * from db_product";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {

      echo "id: ". $row["db_id"] .", product name: ". $row["db_product_name"] .", product price: ". $row["db_product_price"] ."<br/>";
    }
  } else {
    echo "0 results";
  }

  mysqli_close($conn);
 ?>
