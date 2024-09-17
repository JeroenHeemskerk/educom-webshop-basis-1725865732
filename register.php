<?php
include "formData.php";
include "formBuilder.php";
function showTitle()
{
    echo "Register";
}
function showBody()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $formResults = getDataFromPost(getFormData("register"));
        $valid = !containsErrors($formResults);

        if(!$valid)
        {
            openForm("register.php", "Register");
            foreach(getFormData("register") as $key => $metaData)
            {
                $formResult = ['value' => $formResults[$key]['value'], 'error' => $formResults[$key]['error']];
                showFormField($key, $metaData, $formResult);
            }
            closeForm("Register");
        }
        else
        {
            writeUserToFile($formResults['Email']['value'], $formResults['Name']['value'], $formResults['Password']['value']);
            header("Location: index.php?page=login.php");
        }
    }
    else
    {
        //show empty form
        openForm("register.php", "Register");
        foreach(getFormData("register") as $key => $metaData)
        {
            $formResult = ['value' => '', 'error' => ''];
            showFormField($key, $metaData, $formResult);
        }
        closeForm("Register");

    }
}

?>