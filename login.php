<?php

// this file will handle login page

require_once "config.php";
session_start();
if(isset($_SESSION["signup"])==true)
{
  $_SESSION['status'] = "Signup Successful. please login.";
}
//check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}

$fname = $username = $password = "";
$err = "";

// if request method is post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
        $_SESSION['status'] = "Please enter user name and password";
    }
    else{
        $username =trim($_POST['username']);
        $password =trim($_POST['password']);
    }
  }
if(empty($err))
    {
        //get details from the DB for the user
        $sql = "SELECT fname, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn,$sql);
        $param_username = $username;
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        // try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt,$fname, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password,$hashed_password)){
                    // this means password is correct
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["fname"] = $fname;
                    $_SESSION["loggedin"] = true;
                    
                    //redirect user to welcome page
                    header("location: welcome.php");
                    }
                }
            }
        }
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
          <a class="nav-link" href="register.php">Sign Up</a>
        </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
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
  <div class="split-screen">
    <div class="left">
        <section class="copy">
        <h1>Welcome!</h1>
        <p>Place to learn and explore more and more.</p>
        </section>
  </div>
  <div class="right">
        <form action="" method="post">
          <section class="copy">
            <h2>Login</h2>
            <div class="login-container">
                 <p>Are you a new user? <a class="link" href="register.php">
                 <strong>Sign Up</strong></a></p>
            </div>
          </section>
          <div class="input-container email">
             <label for="email">User Name</label>
             <input id="email" name="username" type="email" placeholder="Email">
          </div>
          <div class="input-container password">
             <label for="password">Password</label>
             <input id="password" name="password" placeholder="Write your password here."
              type="password">
            <i class="far fa-eye-slash"></i>
          </div>
          <button class="signup-btn" type="submit">Login</button>
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