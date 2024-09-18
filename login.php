<?php
function showTitle()
{
    echo "Login";
}

function showBody()
{
    if (getPostVar("formDataName") === "login")
    {
        $formResults = getDataFromPost(getFormData("login"));
    }
    else
    {
        $formResults = createEmptyFormData("login");
    }
        
    showForm($formResults, "login", "login.php", "Login", "Login");
    
}

?>