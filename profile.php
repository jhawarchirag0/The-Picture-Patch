<!DOCTYPE html>
<html lang="en">
<head>
    <title>Template</title>
    <link rel="stylesheet" href="./css-files/styles-profile.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molle:400i|Pacifico|Manrope:wght@300|Work+Sans|Righteous|Acme|Jost|Open+Sans:wght@600&display=swap" rel="stylesheet"> 
</head>
<?php

// Connecting to MongoDB and retriving previous bookings
$connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$customer = "Jesse";
$filter =  ['Customer' => $customer];
$query1 = new MongoDB\Driver\Query($filter, []);
$rows   = $connection->executeQuery('picture_patch.bookings', $query1);

// Connecting to phpMyAdmin to retrive user details
$username = "jesse7";
$db = mysqli_connect('localhost','root','','picture_patch') or 
die('Error connecting to MySQL server.');
$query2 = 'SELECT * FROM userdetails where Username = "' . $username . '"';
mysqli_query($db, $query2) or die('Error querying database.');
$result = mysqli_query($db, $query2);
$row = mysqli_fetch_array($result);
?>

<body>
    <header class="Company">The Picture Patch</header>
    <ul class = "nav-bar">
        <li class = "nav-element nav-link"><a class = "nav-text" href = "home.html">Home</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "gallery.html">Catalogue</a></li>
        <li class = "nav-element nav-link"><a class = "nav-text" href = "./signup.html">Sign Up/Log in</a></li>
    </ul>
    <div class="container">
        <div class="name-and-image">
            <div class="name">
                <div class="profile-name">Hello <?php echo $row["FirstName"] ?></div>
            </div>
            <div class="image-box">
                <img src="https://demos.creative-tim.com/argon-dashboard/assets/img/theme/team-4.jpg" class="profile-image" alt="Profile Picture">
            </div>
        </div>
        <div class="profile-box">
            <div class="profile-settings">
                <div class="card">
                    <div class="my-account">My Account</div>
                    <div class="update-button">
                        <button class="update-profile" type="submit">Update</button>
                    </div>
                </div>
                <div class="profile-details">
                    <div class="detail-title">USER INFORMATION</div>
                    <div class="user-info">
                        <div class="part">
                            <div class="feild">
                                <div class="value-title">First Name</div>
                                <input type="text" class="value-box" value="<?php echo $row["FirstName"] ?>">
                            </div>
                            <div class="feild">
                                <div class="value-title">Last Name</div>
                                <input type="text" class="value-box" value="<?php echo $row["LastName"] ?>">
                            </div>
                        </div>
                        <div class="part">
                            <div class="feild">
                                <div class="value-title">Username</div>
                                <input type="text" class="value-box" value="<?php echo $row["Username"] ?>">
                            </div>
                            <div class="feild">
                                <div class="value-title">Email Address</div>
                                <input type="text" class="value-box" value="<?php echo $row["EmailId"] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <hr>
                    </div>
                    <div class="detail-title">CONTACT INFORMATION</div>
                    <div class="contact-info">
                        <div class="part">
                            <div class="feild">
                                <div class="value-title">Address</div>
                                <input type="text" class="value-box" value="<?php echo $row["Address"] ?>">
                            </div>
                            <div class="feild">
                                <div class="value-title">Country</div>
                                <input type="text" class="value-box" value="<?php echo $row["Country"] ?>">
                            </div>
                        </div>
                        <div class="part">
                            <div class="feild">
                                <div class="value-title">City</div>
                                <input type="text" class="value-box" value="<?php echo $row["City"] ?>">
                            </div>
                            <div class="feild">
                                <div class="value-title">Contact</div>
                                <input type="text" class="value-box" value="<?php echo $row["Contact"] ?>">
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="booking-data">
                <div class="card card2">
                    <div class="my-bookings">Previous Bookings</div>
                </div>
                <div class="booking-details">
                    <?php
                    foreach ($rows as $doc) {
                        echo '<div class="data-box">';
                        echo '<div class="data">';
                        echo '<div>Event : '.$doc->event.'</div>';
                        echo '<div>Date : '.date("d M Y",strtotime($doc->date->toDateTime()->format('r'))).'</div>';
                        echo '<div>Location : '.$doc->Location.'</div>';
                        echo '<div>Photographer Hired : </div>';
                        echo '<div>'.$doc->Photographer.'</div><br>';
                        echo '<div>Photos<br>';
                        $images = $doc->images;
                        for($i = 0; $i<sizeof($images); $i++){
                            $image = imagecreatefromstring($images[$i]->getData());
                            $path = $doc->_id."_".$i.".png";
                            imagepng($image, $doc->_id."_".$i.".png");
                            echo "<img src='".$path."' width='65' height='50' <br> ";
                            // unlink($path);
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>