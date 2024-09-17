<?php
include "formData.php";
include "formBuilder.php";
    function showTitle()
    {
        echo 'Contact';
    }
    
    function showBody()
    {
        $valid = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $formResults = getDataFromPost(getFormData("contact"));
            $valid = !containsErrors($formResults);
        }
        else //Method is GET
        {
            $formResults = createEmptyFormData("contact");
        }

        if(!$valid)
        {
            showForm($formResults, "contact", "contact.php", "Contact us", "Send");
        }
        else //all data is valid. Show thank you message.
        {
            echo "Thank you for your message, we will be in contact soon. </br>
            Your details are: <br>";
            foreach($formResults as $key => $formResult)
            {
                echo $key . ": " .$formResult['value']. "<br>";
            }
        }
    }
    ?>