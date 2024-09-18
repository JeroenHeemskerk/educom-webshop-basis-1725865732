<?php
function showTitle()
{
    echo "Login";
}

function showBody()
{
    $valid = false;
    if (getPostVar("formDataName") === "login")
    {
        $formResults = getDataFromPost(getFormData("login"));
        $valid = !containsErrors($formResults);
    }
    else
    {
        $formResults = createEmptyFormData("login");
    }

    if(!$valid)
    {
        showForm($formResults, "login", "login.php", "Login", "Login");
    }
    else //all data is valid.
    {
        $_SESSION['user'] = getUserFromFile($formResults['Email']['value']);
    }
}

?>