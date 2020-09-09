<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["fn"])){
            $fnErr = "First name is required!";
        }
        else{
            $firstName = test_input($_POST["fn"]);
            if(!is_string($firstName)){
                $fnErr = "First name should consist charachters only!";
            }
        }

        if(empty($_POST["ln"])){
            $lnErr = "Last name is required!";
        }
        else{
            $lastName = test_input($_POST["ln"]);
            if(!is_string($lastName)){
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
            else if($age>0{
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
                $repssErr = "Passwords don't match!"
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