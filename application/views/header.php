<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $title ?></title>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>

        <?php foreach ($css as $thecss): ?>
            <link rel="stylesheet" href="<?php echo $thecss; ?>">
        <?php endforeach; ?>

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <?php foreach ($js as $thejs): ?>
            <script src="<?php echo $thejs ?>"></script>
        <?php endforeach; ?>

    </head>
    <body>