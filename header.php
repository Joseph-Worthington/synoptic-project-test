<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <title>Document</title>

    
    <?php 
    include 'db_connection.php';

    $conn = OpenCon(); 

    // include 'functions.php';
    
    ?>
</head>
<body>
    <main> 
        <header>
            <nav>
                <ul>
                    <li>
                        <a>Home</a>
                    </li>
                    <li>
                        <a>Portfolio</a>
                    </li>
                    <li>
                        <a>Basket</a>
                    </li>
                    <li>
                        <a>Checkout</a>
                    </li>
                </ul>
            </nav>
        </header>