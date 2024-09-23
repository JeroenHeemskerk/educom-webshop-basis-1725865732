<?php
    function showTitle()
    {
        echo 'Contact';
    }
    
    function showBody()
    {
        $valid = false;
        if (getPostVar("formDataName") === "contact")
        {
            $formResults = getDataFromPost(getFormData("contact"));
            $valid = !containsErrors($formResults);
        }
        else
        {
            $formResults = createEmptyFormData("contact");
        }

        if(!$valid)
        {
            showForm($formResults, "contact", "contact.php", "Contact us", "Send");
        }
        else //all data is valid. Show thank you message.
        {
            showThankYouMessage($formResults);
        }
    }

function showThankYouMessage($formResults)
{
    echo "Thank you for your message, we will be in contact soon. </br>
    Your details are: <br>";
    foreach($formResults as $key => $formResult)
    {
        echo $key . ": " .$formResult['value']. "<br>";
    }

}
    ?>