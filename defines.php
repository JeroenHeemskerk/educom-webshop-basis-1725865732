<?php
define ("GENDERS", array('Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Other' => 'Other'));
define("COMMUNICATION_PREFERENCES", array('Email' => 'Email', 'Phone' => 'Phone', 'Mail' => 'Mail'));

function updateAllowedPages()
{
    if(empty($_SESSION['user']))
    {
        $_SESSION['allowedPages'] = array('home.php', 'about.php', 'contact.php', 'register.php', 'login.php');
    }
    else
    {
        $_SESSION['allowedPages'] = array('home.php', 'about.php', 'contact.php', 'logout.php');
    }
}
?>