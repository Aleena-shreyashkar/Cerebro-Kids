<?php
require_once "config.php";
$fname = $username = $password =$confirm_password ="";
$fname_err = $username_err = $password_err = $confirm_password_err ="";

// check if the request method is post
if($_SERVER['REQUEST_METHOD']=="POST"){
  //check if username is empty or not
  // by accessing the value entered by user
  if(empty(trim($_POST["username"]))){
    $username_err = "username can't be blank";
    $_SESSION['status'] = "Username can't be blank";
  }
  else{
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    if($stmt)
    {
      mysqli_stmt_bind_param($stmt,"s",$param_username);

      //set the value of parameter username
      $param_username = trim($_POST['username']);

      //try the execute this sql statement
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        //check if the user already exists in the DB
        if(mysqli_stmt_num_rows($stmt) == 1){
          $username_err ="This username is already taken.";
          $_SESSION['status'] = "This username is already taken";
        }
        else{
          $username = trim($_POST['username']);
        }
      }
      else{
        echo "something went wrong";
        $_SESSION['status'] = "something went wrong";
      }
    }
  }
  mysqli_stmt_close($stmt);

//check for password
if(empty(trim($_POST['password']))){
  $password_err = "Password can not be blank";
  $_SESSION['status'] = "Password can not be blank";
}
//check if the length of password >=6
elseif(strlen(trim($_POST['password'])) < 6){
  $password_err = "Password must be at least 6 characters";
  $_SESSION['status'] = "Password must be at least 6 characters";
}
else{
  $password = trim($_POST['password']);
}

//check if the password and coonfirm password fields match
if(trim($_POST['password']) != trim($_POST['confirm_password'])){
  $confirm_password_err = "Password not matching";
  $_SESSION['status'] = "Password not matching";
}

//if no errors, insert details in database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
  $sql ="INSERT INTO users (fname,username,password) VALUES (?,?,?)";
  $stmt = mysqli_prepare($conn,$sql);
  if($stmt)
  {
    //set parameters
    $param_fname = $fname;
    $param_username = $username;
    $param_password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $fname,$param_username,$param_password);

    //try to execute query
    if(mysqli_stmt_execute($stmt))
    {
      if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();
      $_SESSION['status'] = "SignUp successful. Please LOGIN";
      $_SESSION["signup"] = true;
      header("location: login.php");
    }
    else{
      echo "something went erong...can't redirect!";
    }
  }
  
  mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>PHP Register System!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Cerebro Kids</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="split-screen">
    <div class="left">
        <section class="copy">
        <h1>Welcome!</h1>
        <p>Place to learn and explore more and more.</p>
        </section>
  </div>
  <div class="right">

  
        <form action="" method="post">
        <?php
 if(isset($_SESSION['status']))
 {
   ?>
   <div class="alert alert-warning alert-dismissible fade show" role="alert">
     <?php echo $_SESSION['status']; ?>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  unset($_SESSION['status']);
 }

?>
          <section class="copy">
            <h2>Sign Up</h2>
            <div class="login-container">
                 <p>Already have an account? <a class="link" href="login.php">
                 <strong>Log In</strong></a></p>
            </div>
          </section>
          <div class="input-container name">
             <label for="fname">Full Name</label>
             <input id="fname" name="fname" required type="text" placeholder="Enter your full name here">
          </div>
          <div class="input-container email">
             <label for="email">Email</label>
             <input id="email" name="username" required type="email" placeholder="Email">
          </div>
          <div class="input-container password">
             <label for="password">Password</label>
             <input id="password" name="password"  required placeholder="Must be at least 6 characters"
              type="password">
            <i class="far fa-eye-slash"></i>
          </div>
          <div class="input-container password">
             <label for="confirm_password">Confirm Password</label>
             <input id="confirm_password" required name="confirm_password" type="password">
          </div>
          <button class="signup-btn" type="submit">Sign Up</button>
          <section class="copy legal">
              <p><span class="small">By continuing, you agree to accept our<br><a class="link" href="#">Privacy Policy</a>.
              </span></p>
          </section>
        </form>
    </div> 
  </div> 

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

  </body>
</html>