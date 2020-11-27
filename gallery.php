<?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["event"] = $_POST["event"];
        echo '<script>alert("'.$_SESSION["event"].'")</script>';
        header("Location: search.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Catalogue</title>
    <link rel=stylesheet href="./css-files/styles_gallery.css">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Righteous|Acme|Jost&display=swap" rel="stylesheet">
</head>
<body>
    <center>
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
    </center>
    <form action="" method="POST">
        <div  class = 'grid-container'>
            <button type = "submit" name = "event" value = "Wedding" class = 'grid-item-1 gallery__img'>
                    <p class="event-style">Wedding</p>
            </button>
            <button type = "submit" name = "event" value = "Kids" class = 'grid-item-2 gallery__img'>
                    <p class="event-style">Kids</p>
            </button>
            <button type = "submit" name = "event" value = "Fashion and Portfolio" class = 'grid-item-3 gallery__img'>
                    <p class="event-style">Fashion and Portfolio</p>
            </button>
            <button type = "submit" name = "event" value = "Commercial" class = 'grid-item-4 gallery__img'>
                    <p class="event-style">Commercial</p>
            </button>
            <button type = "submit" name = "event" value = "Nature" class = 'grid-item-5 gallery__img'>
                    <p class="event-style">Nature</p>
            </button>
        </div>
    </form>
</body>
</html>