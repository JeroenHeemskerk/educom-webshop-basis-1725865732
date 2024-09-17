<?php
include "formData.php";
include "formBuilder.php";
function showTitle()
{
    echo "Login";
}

function validateLogin($email, $password)
{
    echo "validateLogin";
    $user = getUserFromFile($email);
    var_dump($user['Password']);
    var_dump($password);
    if($user['Password'] == $password)
    {
        echo "true";
        return true;
    }
    echo "false";
    return false;
}

function showBody()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $formResults = getDataFromPost(getFormData("login"));
        $valid = !containsErrors($formResults);

        if(!$valid)
        {
            openForm("login.php", "Login");
            foreach(getFormData("login") as $key => $metaData)
            {
                $formResult = ['value' => $formResults[$key]['value'], 'error' => $formResults[$key]['error']];
                showFormField($key, $metaData, $formResult);
            }
            closeForm();
        }
        else
        {
            if(validateLogin($formResults['Email']['value'], $formResults['Password']['value']))
            {
                header("Location: index.php?");
            }
            else
            {
                openForm("login.php", "Login");
                foreach(getFormData("login") as $key => $metaData)
                {
                    $formResult = ['value' => $formResults[$key]['value'], 'error' => $formResults[$key]['error']];
                    showFormField($key, $metaData, $formResult);
                }
                closeForm("Login");
            }
        }
    }
    else
    {
        //show empty form
        openForm("login.php", "Login");
        foreach(getFormData("login") as $key => $metaData)
        {
            $formResult = ['value' => '', 'error' => ''];
            showFormField($key, $metaData, $formResult);
        }
        closeForm("Login");

    }
}

?>