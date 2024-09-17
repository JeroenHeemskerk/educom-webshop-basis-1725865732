<?php
include "formData.php";
include "formBuilder.php";
    function showTitle()
    {
        echo 'Contact';
    }
    
    function showBody()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $formResults = getDataFromPost(getFormData("contact"));
            
            $valid = !containsErrors($formResults);

            if(!$valid)
            {
                openForm("contact.php", "Contact us");
                foreach(getFormData("contact") as $key => $metaData)
                {
                    $formResult = ['value' => $formResults[$key]['value'], 'error' => $formResults[$key]['error']];
                    showFormField($key, $metaData, $formResult);
                }
                closeForm("Send");
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
        else //Method is GET
        {
            //show empty form
            openForm("contact.php", "Contact us");
            foreach(getFormData("contact") as $key => $metaData)
            {
                $formResult = ['value' => '', 'error' => ''];
                showFormField($key, $metaData, $formResult);
            }
            closeForm("Send");
        }
    }
    ?>