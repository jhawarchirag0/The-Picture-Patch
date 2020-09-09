<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css-files/styles2-signup.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Righteous|Zhi+Mang+Xing|Jost&display=swap" rel="stylesheet"> 
</head>
<body>

    <?php

    $fnErr = "";
    $lnErr = "";
    $contactErr = "";
    $ageErr = "";
    $emailErr = "";
    $usernameErr = "";
    $pssErr = "";
    $repssErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["fn"])){
            $fnErr = "First name is required!";
        }
        else{
            $firstName = test_input($_POST["fn"]);
            if(!ctype_alpha($firstName)){
                $fnErr = "First name should consist charachters only!";
            }
        }

        if(empty($_POST["ln"])){
            $lnErr = "Last name is required!";
        }
        else{
            $lastName = test_input($_POST["ln"]);
            if(!ctype_alpha($lastName)){
                $lnErr = "Last name should consist charachters only!";
            }
        }

        if(empty($_POST["contact"])){
            $contactErr = "Contact is required!";
        }
        else{
            $contact = test_input($_POST["contact"]);
            if(!is_numeric($contact)){
                $contactErr = "Contact should consist numbers only!";
            }
            else if(strlen($contact)!=10){
                $contactErr = "Contact should be of 10 digits!";
            }
        }

        if(empty($_POST["age"])){
            $ageErr = "Age is required!";
        }
        else{
            $age = (int)test_input($_POST["age"]);
            if(!is_numeric($age)){
                $ageErr = "Age should be a number!";
            }
            else if($age>0){
                $ageErr = "Age should be positive!";
            }
        }

        if(empty($_POST["emailid"])){
            $emailErr = "Email is required!";
        }
        else{
            $emailid = test_input($_POST["emailid"]);
            if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        
        if(empty($_POST["username"])){
            $usernameErr = "Username is required!";
        }
        else{
            $username = test_input($_POST["username"]);
        }

        if(empty($_POST["pss"])){
            $pssErr = "Password is required!"; 
        }
        else{
            $pss = test_input($_POST["pss"]);
            if (strlen($pss) <= 8) {
                $pssErr = "Your Password Must Contain At Least 8 Characters!";
            }
            elseif(!preg_match("#[0-9]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Number!";
            }
            elseif(!preg_match("#[A-Z]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif(!preg_match("#[a-z]+#",$pss)) {
                $pssErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
        }

        if(empty($_POST["repss"])){
            $repssErr = "Retype Password!"; 
        }
        else{
            $repss = test_input($_POST["repss"]);
            if($repss!=$pss){
                $repssErr = "Passwords don't match!";
            }
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
        <li class = "nav-element nav-link"><a class = "nav-text" href = "home.html">Home</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "gallery.html">Catalogue</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "#">Booking</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "./signup.html">Sign Up/Log in</a></li>
    </ul>
    <div class="container">
        <h2 class='signup' align='center'>
            Sign Up
        </h2>
        <form class='form2' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input id='fn' type='text' placeholder="First Name" name="fn" />
            <div class="error"> <?php echo $fnErr;?></div><br>

            <input id='ln' type='text' placeholder="Last Name" name="ln" />
            <div class="error"> <?php echo $lnErr;?></div><br>

            <input id="contact" type="text" name="contact" placeholder="Contact Number" />
            <div class="error"> <?php echo $contactErr;?></div><br>

            <input id="age" type="text" name="age" placeholder="Age" />
            <div class="error"> <?php echo $ageErr;?></div><br>

            <div id="gender">
                <label>Gender :</label>
                <br><br>
                <input type="radio" id="male" name="gender" value="male" checked>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <input type="radio" id="transgender" name="gender" value="transgender">
                <label for="transgender">Transgender</label>
            </div>

            <input id='emailid' type='text' name="emailid" placeholder="Email Address" />
            <div class="error"> <?php echo $emailErr;?></div><br>

            <input id="username" type='text' name="username" placeholder="Username" />
            <div class="error"> <?php echo $usernameErr;?></div><br>

            <input type='Password' id="pss" name="pss" placeholder="Password" />
            <div class="error"> <?php echo $pssErr;?></div><br>

            <input type='Password' id="repss" name="repss" placeholder="Retype Password" />
            <div class="error"> <?php echo $repssErr;?></div><br>

            <!-- <center>
                <p id="pass-req">Password must contain min 8 characters, 1 uppercase, 1 lowercase, 1 number and 1 special character</p>
            </center> -->
            <input type="submit" class="submit" name="submit" align="center" value="Sign up"> <br>
        </form>
        <h2 class='redirect-sign-in' align='center'> 
            <a class='redirect2' href='./login.html' style="text-decoration: none">Already joined?Sign In</a>
        </h2 >
    </div>
    <!-- <footer class="footer">
        Made by Chirag
    </footer> -->

</body>
</html>