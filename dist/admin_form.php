<?php
  session_start();
  if(!isset($_SESSION["logged_in"])) {
    $error = urlencode("You have to login first");
    header("Location:login.php?err=".$error);
  }

  // define variables and set to empty values
  $nameErr = $mobileErr = $packageErr = $dateErr = "";
  $name = $mobile = $package = $date = "";
  $stat = array();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    array_push($stat, $nameErr);
  } else {
    $name = test_input($_POST["name"]);

    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      array_push($stat, $nameErr);
    }
  }

  if (empty($_POST["mobile"])) {
    $mobileErr = "mobile number is required";
    array_push($stat, $mobileErr);
  } else {
    $mobile = test_input($_POST["mobile"]);

    if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $mobile)) {
      $mobileErr = "Enter as like example";
      array_push($stat, $mobileErr);
    }
  }

  if (empty($_POST["package"])) {
    $packageErr = "package selection required";
    array_push($stat, $packageErr);
  } else {
    $package = test_input($_POST["package"]);
  }

  if (empty($_POST["date"])) {
    $dateErr = "date is required";
    array_push($stat, $dateErr);
  } else {
    $date = test_input($_POST["date"]);
  }
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

if(!empty($stat)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn) {
      die("Connection failed: ".mysqli_connect_error());
    }
    // date_default_timezone_set("Asia/Dhaka");
    // $from_date = date("")
    // $sql = "insert into client values (NULL, '".$name"', '".$mobile."', )"
} else {

}

date_default_timezone_set("Asia/Dhaka");

$from_date = new DateTime();

echo $name."<br/>";
echo $mobile."<br/>";
echo $package."<br/>";
echo $date."<br/>";
// echo $from_date."<br />";
echo $from_date->diff($date)->format("%d days")."<br/>";
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin Form</title>
        <link href="css/styles.css" rel="stylesheet" />
        <style>
          .error {
            color: red;
          }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">

                                            <!-- <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" /></div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" /></div>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                              <label class="small mb-1" for="inputPhoneNumber">Phone Number</label>
                                              <input class="form-control py-4" id="inputPhoneNumber" name="mobile" type="tel" aria-describedby="phoneHelp" placeholder="Enter phone number, example. xxx-xxxx-xxxx" />
                                              <span class="error"><?php echo $mobileErr; ?></span>
                                            </div>

                                            <div class="form-group">
                                              <label class="small mb-1" for="inputUserName">Name</label>
                                              <input class="form-control py-4" id="inputUserName" type="text" name="name" aria-describedby="nameHelp" placeholder="Enter name" />
                                              <span class="error"><?php echo $nameErr; ?></span>
                                            </div>

                                            <!-- <div class="form-group">
                                              <label class="small mb-1" for="inputEmailAddress">Package</label>
                                              <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                            </div> -->

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label class="small mb-1" for="package">Package</label>
                                                      <br>
                                                      <div id="dropdown">
                                                        <select name="package">
                                                          <option value="50mb">50mb</option>
                                                          <option value="100mb">100mb</option>
                                                          <option value="1gb">1gb</option>
                                                          <option value="2gb">2gb</option>
                                                        </select>
                                                      </div>
                                                      <span class="error"><?php echo $packageErr; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label class="small mb-1" for="time">Time</label>
                                                      <input class="form-control" id="time" name="date" type="date" placeholder="date"/>
                                                      <span class="error"><?php echo $dateErr; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><input type="submit" class="btn btn-primary btn-block" value="Get Password"></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="index.php">Get Back to dashboard</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
