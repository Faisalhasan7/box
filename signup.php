<?php

    if(isset($_POST['submit'])){
        include("connection.php");
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        
        $sql="select * from signup where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signup where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO signup(username, email, password) VALUES('$username', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: login.php");
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>box</title>
</head>
<body>

    <section id="signup">
       <div class="signup">
        <div class="form">
            <h1>signup</h1>

            <form name="form" action="signup.php" method="POST">
                <label for="username">username</label>
                <input type="text" id="username" name="username" required> <br>
                <label for="email">email</label>
                <input type="text" id="email" name="email" required> <br>
                <label for="password">password</label>
                <input type="password" id="password" name="password" required> <br>
                <label for="cpassword">confirm passowrd</label>
                <input type="password" id="cpassword" name="cpassword" required>
                <input type="submit" id="btn" value="signup" name="submit"/>
            </form>
            <a href="login.php">login</a>
        </div>
       </div>
    </section>
</body>
</html>