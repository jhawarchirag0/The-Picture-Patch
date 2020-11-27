<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search for Photographers</title>
    <link rel="stylesheet" href="./css-files/styles_search.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Nunito:wght@600|Righteous|Acme|Jost&display=swap" rel="stylesheet"> 
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
        <div class="search-header">
            <div class="search-header1">Hire Proffesional Photographers</div>
            <div class="search-header2">MAKE YOUR MEMORABLE MOMENTS CAPTURED</div>
        </div>
        <div class="search-box">
            <div class="search-navbar">
                <div class="filters">Filter</div>
                <form class="category" method="POST" action="">
                    <label class="category-name" for="event">Event : </label>
                    <select id="event" name="event">
                        <?php
                            $search = $_SESSION["event"];
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $search = $_POST["event"];
                            }
                            $list  = array("Kids", "Wedding", "Fashion and Portfolio", "Commercial", "Nature");
                            for($a = 0;$a<sizeof($list);$a++){
                                if($list[$a]==$search){
                                    echo '<option value="'.$search.'" selected>'.$search.'</option>';
                                }
                                else{
                                    echo '<option value="'.$list[$a].'">'.$list[$a].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <button class="search-button" type="submit">Search</button>
                </form>
            </div>
            <div class="result-box">
            <?php
            $connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query = new MongoDB\Driver\Query([], []);
            $rows   = $connection->executeQuery('picture_patch.photographers', $query);
            foreach ($rows as $doc) {
                $expertise = $doc->expertise;
                for($i=0;$i<sizeof($expertise);$i++){
                    if($expertise[$i]==$search){
                        echo '<form class="result-card">';
                        echo '<div class="profile-image">';
                        $images = $doc->images;
                        for($j = 0; $j<sizeof($images); $j++){
                            $image = imagecreatefromstring($images[$j]->getData());
                            $path = $doc->_id."_".$j.".png";
                            imagepng($image, $doc->_id."_".$j.".png");
                            echo '<img src="'.$path.'" class="align-image" width="200">';
                        }
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo '<div class="photographer-name">'.$doc->name.'</div>';
                        echo '<div class="photographer-info">';
                        echo '<div class="info">';
                        echo 'Experience: '.$doc->experience.' Yrs';
                        echo '</div>';
                        echo '<div class="info">';
                        echo 'Expertise: ';
                        $e =  $doc->expertise;
                        for($j = 0; $j<sizeof($e); $j++){
                            echo $e[$j];
                            if($j<sizeof($e)-1){
                                echo ", ";
                            }
                        }
                        echo '</div>';
                        echo '<div class="info">';
                        echo 'Hiring Charges: Rs.'.$doc->hiring_charges;
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="update-button">';
                        echo '<button class="update-profile" type="submit">Hire</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                    }
                }
            }

            ?>
            </div>
        </div>
    </div>
</body>
</html>