<?php
function showTitle()
{
    echo "Register";
}
function showBody()
{
    if (getPostVar("formDataName") === "register")
    {
        $formResults = getDataFromPost(getFormData("register"));
    }
    else
    {
        $formResults = createEmptyFormData("register");
    }

    showForm($formResults, "register", "register.php", "Register", "Register");
}

?>