<?php

include 'functions.php';
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    header('Location: login.php');
} else { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="flex-column center-hor">
<?php

loadHeader();

function wow($num) {
    for ($i=0; $i < 500; $i++) {
        if ($num%2 === 0) {
            echo 'wow';
        } else {
            echo 'sasquatch<br>';
        }
    }
}

function mySQLInput($input) {
    

    $q = "INPUT INTO accounts WHERE ";
}
function mySQLQuery($query) {

}


$num = 5;
wow($num);



loadFooter();
?>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="main.js"></script>
</body>
</html>
<?php
}
?>

