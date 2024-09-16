<?php
include "defines.php";

function getContactFormData()
{
    global $COMMUNICATION_PREFERENCES;
    global $GENDERS;
    return
    [
        'Gender' => ['label' => 'Gender', 'type' => 'select', 'placeholder' => 'Mr.','options' => $GENDERS, 'validations' => ["notEmpty", "validOption"]],
        'Name'  => ['label' => 'Full Name', 'type' => 'text', 'placeholder' => 'Full name', 'validations' => ["notEmpty", "onlyCharacters"]],
        'Email' => ['label' => 'Email', 'type' => 'text', 'placeholder' => 'Example@example.com', 'validations' => ["notEmptyIf:communication:Email", "validEmail"]],
        'Phonenumber' => ['label' => 'Phone Number', 'type' => 'text', 'placeholder' => '0612345678', 'validations' => ["notEmptyIf:communication:Phone", "validPhoneNumber"]],
        'Streetname' => ['label' => 'Streetname', 'type' => 'text', 'placeholder' => 'Streetname', 'validations' => ["notEmptyIf:communication:Mail", "onlyCharacters"]],
        'Housenumber' => ['label' => 'Nr + addition', 'type' => 'text', 'placeholder' => '123A01', 'validations' => ["notEmptyIf:communication:Mail", "validHouseNumber"]],
        'Zipcode' => ['label' => 'Zipcode', 'type' => 'text', 'placeholder' => '1234AB', 'validations' => ["notEmptyIf:communication:Mail", "validZipcode"]],
        'City' => ['label' => 'City', 'type' => 'text', 'placeholder' => 'City', 'validations' => ["notEmptyIf:communication:Mail", "onlyCharacters"]],
        'CommunicationPreference' => ['label' => 'Communication', 'type' => 'radio', 'placeholder' => 'Email', 'options' => $COMMUNICATION_PREFERENCES, 'validations' => ["notEmpty", "validOption"]],
        'Message' => ['label' => 'Message', 'type' => 'textarea', 'placeholder' => 'Message', 'validations' => ["notEmpty"]]
    ];
}

    function showFormField($key, $metaData, $formResult)
    {
        switch($metaData['type'])
        {
            case 'text':
                echo '
                <div class="form-group">
                <label class="control-label">'.$metaData['label'].'</label>
                <input class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" value="'.$formResult['value'].'"></input>';
                if(!empty($formResult['error']))
                {
                    echo '<span class="error">* '.$formResult['error'].'</span>';
                }
                echo '
                </div>';
            break;
            case 'textarea':
                echo '
                <div class="form-group">
                <label class="control-label">'.$metaData['label'].'</label>
                <textarea class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" ">'.$formResult['value'].'</textarea>';
                if(!empty($formResult['error']))
                {
                    echo '<span class="error">* '.$formResult['error'].'</span>';
                }
                echo '
                </div>';
            break;
            case'select':
                echo '
                <div class="form-group">
                <label class="control-label">'.$metaData['label'].'</label>
                <select name="'.$key.'">';
                foreach($metaData['options'] as $option_key => $option_value)
                {
                    echo '<option value="'.$option_key.'"';
                    if($formResult['value'] == $option_key)
                    {
                        echo'selected';
                    }
                    echo' >'.$option_value.'</option>';
                }
                
                echo '</select>';
                if(!empty($formResult['error']))
                {
                    echo '<span class="error">* '.$formResult['error'].'</span>';
                }
                echo '
                </div>';
            break;
            case 'radio':
                
                echo '
                <div class="form-group">
                <label class="control-label">'.$metaData['label'].'</label>';
                foreach($metaData['options'] as $option_key => $option_value)
                {
                    echo '
                    <div class="radio">
                    <input type="radio" name= "'.$key.'" value="'.$option_key.'"';
                    if($formResult['value'] == $option_key)
                    {
                        echo'checked="checked"';
                    }
                    echo '>'.$option_value.'</input>
                    </div>';
                }
                if(!empty($formResult['error']))
                {
                    echo '<span class="error">* '.$formResult['error'].'</span>';
                }
                echo '
                </div>';
            break;
            default:
            break;
        }
    
    }

    function getDataFromPost($metaArray)
    {
        include 'formValidation.php';
        $formResults = [];
        foreach($metaArray as $key => $metaData)
        {
            $value = getPostVar($key);
            $formResult = ['value' => $value, 'error' => ''];
            $formResults[$key] = $formResult;
        }
        foreach($metaArray as $key => $metaData)
        {
            $formResult = validateField($key, $metaData, $formResults);
        }
        return $formResults;
    }

    function openForm()
    {
        echo '
        <form method="POST" action="index.php?">
            <fieldset>
                <input type="hidden" name="page" value="contact.php">
                <legend>Contact us</legend>';
    }

    function closeForm()
    {
        echo'
                <div class="form-group">
                    <label class="control-label" for="send"></label>
                    <button name="send" class="btn btn-primary">Send</button>
                </div>
            </fieldset>
        </form>';
    }

    function showTitle()
    {
        echo 'Contact';
    }
    
    function showBody()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $formResults = getDataFromPost(getContactFormData());
            $containsErrors = false;
            foreach($formResults as $key => $formResult)
            {
                if(!empty($formResult['error']))
                {
                    $containsErrors = true;
                }
            }
            $valid = !$containsErrors;

            if(!$valid)
            {
                openForm();
                foreach(getContactFormData() as $key => $metaData)
                {
                    $formResult = ['value' => $formResults[$key]['value'], 'error' => $formResults[$key]['error']];
                    showFormField($key, $metaData, $formResult);
                }
                closeForm();
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
            openForm();
            foreach(getContactFormData() as $key => $metaData)
            {
                $formResult = ['value' => '', 'error' => ''];
                showFormField($key, $metaData, $formResult);
            }
            closeForm();
        }
    }
    ?>