<?php
include "formData.php";
include "formBuilder.php";
function showTitle()
{
    echo "Register";
}
function showBody()
{
    $valid = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $formResults = getDataFromPost(getFormData("register"));
        $valid = !containsErrors($formResults);
    }
    else //Method is GET
    {
        $formResults = createEmptyFormData("register");
    }

    if(!$valid)
    {
        showForm($formResults, "register", "register.php", "Register", "Register");
    }
    else //all data is valid.
    {
        writeUserToFile($formResults['Email']['value'], $formResults['Name']['value'], $formResults['Password']['value']);
        header("Location: index.php?page=login.php");
    }
}

?>