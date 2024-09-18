<?php
function showTitle()
{
    //echo "Login";
}

function validateLogin($email, $password)
{
    $user = getUserFromFile($email);
    if($user != null)
    {
        if($user['Password'] == $password)
        {
            return true;
        }
    }
    return false;
}

function showBody()
{
    $validInput = false;
    $loginErrorMessage = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $formResults = getDataFromPost(getFormData("login"));
        //var_dump($formResults);
            $validInput = !containsErrors($formResults);
            $loginErrorMessage = '<div class="error">Combination of email and password is incorrect</div>';
    }
    else //Method is GET
    {
        $formResults = createEmptyFormData("login");
    }

    $valid = $validInput && validateLogin($formResults['Email']['value'], $formResults['Password']['value']);

    if(!$valid)
    {
        echo $loginErrorMessage;
        showForm($formResults, "login", "login.php", "Login", "Login");
    }
    else //all data is valid.
    {
        $user = getUserFromFile($formResults['Email']['value']);
        
        $_SESSION['user'] = ["Email" => $user['Email'], "Name" => $user['Name']];
    }
}

?>