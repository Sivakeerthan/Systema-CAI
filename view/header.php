<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Systema-CAI</title>

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css" media="screen,projection"/>
    <link href='/js/plugins/fullcalendar/css/fullcalendar.min.css' rel='stylesheet'/>
    <link href='/js/plugins/fullcalendar/css/fullcalendar.print.min.css' rel='stylesheet' media='print'/>
    <link href="/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="header" class="nav-wrapper">

    <?php if (isset($_SESSION['user'])): ?>
        <div class="tooltip-div">
            <h3 id="huname" class="unselectable"><?= $uname ?></h3>

            <ul class="tooltip-content">
                <?php if ($_SESSION['pos'] == 'st'):
                if($kontingent == null){ $kontingent = 0; }?>
                <li class="tooltip-li"> Kontingent: <?= $kontingent ?></li>
                <?php endif;?>
            <li class="tooltip-li" id="llogout">
                <a href="/user/logout/">ausloggen</a>
            </li>
            </ul>
        </div>
        <?php if ($_SESSION['pos'] == 'st' || $_SESSION['pos'] == 'se'): ?>
            <button class="form-btn" id="habsmelden">Absenz Melden</button>
        <?php elseif ($_SESSION['pos'] == 'te'): ?>
            <button class="form-btn">Unentschuldigte Absenz Melden</button>
        <?php elseif ($_SESSION['pos'] == 'pr'): ?>
            <button class="form-btn">Event erstellen</button>
        <?php else: endif; ?>
    <?php else: ?>
        <h3>Systema-CAI</h3>
    <?php endif; ?>


</div>

<div class="container">


    <h1><?= $heading ?></h1>
