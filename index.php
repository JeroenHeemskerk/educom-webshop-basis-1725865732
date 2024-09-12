<?php

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

    return $requestedPage;
}

function showResponsePage($requestedPage)
{
    beginDocument();
    showHeadSection();
    showBodySection($requestedPage);
    endDocument();
}

function getPostVar($key, $default="")
{
    if(!isset($_POST[$key]))
    {  
        return $default;
    }
    $value = $_POST[$key];
    $value = trim($value);
    return $value;
}

function getUrlVar($key, $default="")
{
    if(!isset($_GET[$key]))
    {
        return $default;
    }
    $value = $_GET[$key];
    $value = trim($value);
    return $value;	
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