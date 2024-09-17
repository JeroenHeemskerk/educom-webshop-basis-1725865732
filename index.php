<?php
include "defines.php";
define("allowedPages", ['home.php', 'about.php', 'contact.php', 'register.php', 'login.php']);
beginDocument();
$page = getRequestedPage();
showResponsePage($page);
function getRequestedPage()
{
    $requestedType = $_SERVER['REQUEST_METHOD'];
    if($requestedType == 'POST')
    {
        $requestedPage = getPostVar('page', 'home.php');
    }
    else
    {
        $requestedPage = getUrlVar('page', 'home.php');
    }
    
    if(!in_array($requestedPage, allowedPages))
    {
        echo '<script>alert("Invalid page requested, redirecting to homepage");</script>';
        $requestedPage = 'home.php';
    }
    return $requestedPage;
}

function showResponsePage($requestedPage)
{
    showHeadSection();
    showBodySection($requestedPage);
    endDocument();
}

function getDataFromPost($metaArray)
{
    include 'formValidation.php';
    $formResults = [];
    foreach($metaArray as $key => $metaData)
    {
        $value = getPostVar($key);
        $formResult = ['value' => $value, 'error' => ''];
        $formResults[$key] = $formResult;
    }
    foreach($metaArray as $key => $metaData)
    {
        $formResult = validateField($key, $metaData, $formResults);
    }
    return $formResults;
}

function getArrayVar($array, $key, $default="")
{
    if(!isset($array[$key]))
    {
        return $default;
    }
    $value = $array[$key];
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function getPostVar($key, $default="")
{
    return getArrayVar($_POST, $key, $default);
}

function getUrlVar($key, $default="")
{
    return getArrayVar($_POST, $key, $default);
}

function beginDocument()
{
    echo '<!DOCTYPE html>
    <html lang="en">';

}

function showHeadSection()
{
    echo '<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Webshop</title>
    
        <link rel="stylesheet" href="./CSS/stylesheet.css">
    </head>';
}

function showHeader()
{
    echo '<header> <h1>My Webshop - ';
    echo showTitle();
    echo '</h1>';
    showMenu();
    showDropDownMenu();
    echo '</header>';
}

function showMenu()
{
    echo '
        <ul class="nav-menu">
        <li class="nav-menu-item">
            <a href="index.php?page=home.php" class="menu-link">HOME</a>
        </li>
        <li class="nav-menu-item">
            <a href="index.php?page=about.php" class="menu-link">ABOUT</a>
        </li>
        <li class="nav-menu-item">
            <a href="index.php?page=contact.php" class="menu-link">CONTACT</a>
        </li>
    </ul>';
}

function showDropDownMenu()
{
    echo '
    <div class="dropdown-menu">
        <div class="dropdown-menu-trigger">
            <div class="dropdown">
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a href="index.php?page=login.php" class="menu-link">LOGIN</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="index.php?page=register.php" class="menu-link">REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>';
}

function showFooter()
{
    echo '<footer> &copy 2024 Jochem Grootherder </footer>';
}

function showBodySection($requestedPage)
{
    echo '<body>';
    require $requestedPage;
    showHeader();
    showBody();
    showFooter();

    echo '</body>';
}

function endDocument()
{
    echo'</html>';
}

?>