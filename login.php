<?php
    $login = false;
    
    if (isset($_POST['submit'])) {
        include('connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo $password;
        $sql = "select * from signup where username = '$username' or email = '$username'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($row){  
            echo $count;

            if(password_verify($password, $row["password"])){
                $login=true;
                session_start();

                $sql = "select username from signup where username = '$username'or email = '$username'";     
                $r = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);  

                $_SESSION['username']= $r['username'];
                $_SESSION['loggedin'] = true;
                header("Location: welcome.php");
            }
        }  
        else{  
            echo  '<script>
                        
                        alert("Login failed. Invalid username or password!!")
                        window.location.href = "login.php";
                    </script>';
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


    <section id="login">
        <div class="box">
            <h1>box</h1>
            <form name="form" action="login.php" method="POST">
                <input type="username" placeholder="your username" id="username" name="username" required>
                <input type="password" placeholder="your password" id="password" name="password" required>
                <input type="submit" id="btn" name="submit" value="login">
            </form>
    </div>
    </section>
</body>
</html>