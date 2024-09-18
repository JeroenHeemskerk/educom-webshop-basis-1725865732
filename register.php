<?php
function showTitle()
{
    echo "Register";
}
function showBody()
{
    $valid = false;
    if (getPostVar("formDataName") === "register")
    {
        $formResults = getDataFromPost(getFormData("register"));
        $valid = !containsErrors($formResults);
    }
    else
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
        //header("Location: index.php?page=login.php");
    }
}

?>