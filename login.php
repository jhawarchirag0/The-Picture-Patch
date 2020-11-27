<html>
<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="./css-files/styles1-login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Righteous|Acme|Jost&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    $usernameErr = "";
    $pssErr = "";
    $noError=0;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["un"])){
            $usernameErr = "Username is required!";
            $noError += 1;
        }
        else{
            $username = test_input($_POST["un"]);
        }

        if(empty($_POST["pass"])){
            $pssErr = "Password is required!"; 
            $noError += 1;
        }
        else{
            $pss = test_input($_POST["pass"]);
            if (strlen($pss) <= 8) {
                $pssErr = "Your Password Must Contain At Least 8 Characters!";
                $noError += 1;
            }
            elseif(!preg_match("#[0-9]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Number!";
                $noError += 1;
            }
            elseif(!preg_match("#[A-Z]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Capital Letter!";
                $noError += 1;
            }
            elseif(!preg_match("#[a-z]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
                $noError += 1;
            }
        }
        if($noError==0){
            $db = mysqli_connect('localhost','root','','picture_patch') or 
            die('Error connecting to MySQL server.');

            $query = 'SELECT Password FROM login where Username = "' . $un . '"';
            mysqli_query($db, $query) or die('Error querying database.');
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
            if( empty($row) ){
                $message = "User not registered";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }   
            else if($pass == $row['Password']){
                $message = "Login Success";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else{
                $message = "Login Failed!  Incorrect Username or Password!";
                echo "<script type='text/javascript'>alert('$message');</script>";
        
            }
            mysqli_close($db);

            $_SESSION["username"] = $username;
            header('Location: ./home.php');
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <header class="Company">The Picture Patch</header>
    <ul class = "nav-bar">
        <li class = "nav-element nav-link"><a class = "nav-text" href = "home.php">Home</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "gallery.php">Catalogue</a></li>
        <?php
            if(isset($_SESSION["username"])){
                echo '<li class = "nav-element nav-link"><a class = "nav-text" href = "profile.php">Dashboard</a></li>';
                echo '<li class = "nav-element nav-link"><a class = "nav-text" href = "logout.php">Log Out</a></li>';
            }
            else{
                echo '<li class = "nav-element nav-link"><a class = "nav-text" href = "signup.php">Sign Up/Log in</a></li>';
            }
        ?>
    </ul>
    <div class="container">
        <h2 class='signin' align='center'>
            Log In
        </h2>
        <form class="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          
          <input class="un" type="text" name="un" align="center" placeholder="Username">
          <div class="error"> <?php echo $usernameErr;?></div><br>

          <input class="pass" type="password" name="pass" align="center" placeholder="Password">
          <div class="error"> <?php echo $pssErr;?></div><br>

          <input type="submit" class="submit" align="center" value="Log in"><br><br>
    
          <div id="message">Welcome Back!</div>
          
            <h2 align='center'> 
                <a class="forgot" href="#">Forgot Password?</a>
            </h2 >
    
          <h2 align='center'> 
              <a class='redirect-sign-up' href="./signup.php">New Here? Sign Up</a>
          </h2 >
        </div>
    </div>
</body>
</html>