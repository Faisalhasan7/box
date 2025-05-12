<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
        header("location:login.php");
        exit;
    }
?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
      body {
    height: 100vh;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: top;
    font-family: "Poppins", sans-serif;
  }

  .out-session a {
    justify-content: center;
    align-items: bottom;
  }
</style>
  <body>
      
        <div id="form">
            <h1>Welcome, <?php echo $_SESSION['username'] ?> Let's create a box </h1>
            <a href="upload.php">Start</a>
        </div>


        
        <div class="out-session">
            <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
        </div>

    </body>
</html>