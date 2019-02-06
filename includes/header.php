<!DOCTYPE html>
<?php session_start(); ?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hello World</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php include './admin/functions.php' ?>
    <style>
        #title{
            color: lime;
            font-size: 40px;
            padding: 20px;
            font-family: monospace;
        }
        #sub_title{
            color: #4682B4;
            font-size: 25px;
            padding: 10px;
            font-family: monospace;
            font-weight: lighter;
        }

        body{
            background: #222222;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #222222, #222222, #222222, #222222, #4682B4);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #222222, #222222, #222222, #222222, #4682B4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background-attachment: fixed;

        }
        .not-black{
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .sticky{
            position: sticky;
            position: -webkit-sticky;
            top: 80px;
        }
        .blue{
            color: #4682B4 !important;
        }
        .blue:hover{
            color: white !important;
        }
        .reverse{
            position: absolute;
            right: 50px;

        }
        </style>


</head>

<body>