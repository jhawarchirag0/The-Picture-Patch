<?php
    session_start();
    $fnErr = "";
    $lnErr = "";
    $contactErr = "";
    $ageErr = "";
    $emailErr = "";
    $usernameErr = "";
    $pssErr = "";
    $repssErr = "";
    $noError = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["fn"])){
            $fnErr = "First name is required!";
            $noError += 1;
        }
        else{
            $firstName = test_input($_POST["fn"]);
            if(!ctype_alpha($firstName)){
                $fnErr = "First name should consist characters only!";
                $noError += 1;
            }
        }

        if(empty($_POST["ln"])){
            $lnErr = "Last name is required!";
            $noError += 1;
        }
        else{
            $lastName = test_input($_POST["ln"]);
            if(!ctype_alpha($lastName)){
                $lnErr = "Last name should consist characters only!";
                $noError += 1;
            }
        }

        if(empty($_POST["contact"])){
            $contactErr = "Contact is required!";
            $noError += 1;
        }
        else{
            $contact = test_input($_POST["contact"]);
            if(!is_numeric($contact)){
                $contactErr = "Contact should consist numbers only!";
                $noError += 1;
            }
            else if(strlen($contact)!=10){
                $contactErr = "Contact should be of 10 digits!";
                $noError += 1;
            }
        }

        if(empty($_POST["age"])){
            $ageErr = "Age is required!";
            $noError += 1;
        }
        else{
            $age = (int)test_input($_POST["age"]);
            if(!is_numeric($age)){
                $ageErr = "Age should be a number!";
                $noError += 1;
            }
            else if($age<=0){
                $ageErr = "Age should be positive!";
                $noError += 1;
            }
        }

        if(empty($_POST["emailid"])){
            $emailErr = "Email is required!";
            $noError += 1;
        }
        else{
            $emailid = test_input($_POST["emailid"]);
            if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $noError += 1;
            }
        }
        
        if(empty($_POST["username"])){
            $usernameErr = "Username is required!";
            $noError += 1;
        }
        else{
            $username = test_input($_POST["username"]);
        }

        if(empty($_POST["pss"])){
            $pssErr = "Password is required!"; 
            $noError += 1;
        }
        else{
            $pss = test_input($_POST["pss"]);
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

        if(empty($_POST["repss"])){
            $repssErr = "Retype Password!"; 
            $noError += 1;
        }
        else{
            $repss = test_input($_POST["repss"]);
            if($repss!=$pss){
                $repssErr = "Passwords don't match!";
                $noError += 1;
            }
        }
        $gender = $_POST["gender"];
        // echo $noError;
        if($noError==0){
            $db = mysqli_connect('localhost','root','','picture_patch') or 
            die('Error connecting to MySQL server.');

            $order = "INSERT INTO userdetails
                        (FirstName, LastName, Username, Contact, EmailId, Age, Gender, Paswd)
                        VALUES
                        ('$firstName','$lastName','$username','$contact','$emailid','$age','$gender','$pss')";

            $result = mysqli_query($db,$order);
            if($result){
                echo "<script>alert('Succesfully Signed Up!');</script>";
                $_SESSION["username"] = $username;
                header('Location: home.php');
            } 
            else{
                echo "<script>alert('Something went wrong.Please try again!');</script>";
            }
            mysqli_close($db);
            
            $_SESSION["username"] = $username;
            header('Location: home.php');
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css-files/styles2-signup.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Righteous|Acme|Jost&display=swap" rel="stylesheet"> 
</head>
<body>
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
            <input type="submit" class="submit" name="submit" align="center" value="Sign up"> <br>
        </form>
        <h2 class='redirect-sign-in' align='center'> 
            <a class='redirect2' href='./login.php' style="text-decoration: none">Already joined?Sign In</a>
        </h2 >
    </div>
</body>
</html>