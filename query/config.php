<?php session_start();
    if(isset($_GET['utm_source'])) $_SESSION['utm_source'] = $_GET['utm_source'];
    if(isset($_GET['utm_medium'])) $_SESSION['utm_medium'] = $_GET['utm_medium'];
    if(isset($_GET['utm_campaign'])) $_SESSION['utm_campaign'] = $_GET['utm_campaign'];
    if(isset($_GET['utm_content'])) $_SESSION['utm_content'] = $_GET['utm_content'];
    if(isset($_GET['utm_term'])) $_SESSION['utm_term'] = $_GET['utm_term'];