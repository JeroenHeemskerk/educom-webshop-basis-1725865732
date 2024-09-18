<?php

define("contactData" , [
    'Gender' => ['label' => 'Gender', 'type' => 'select', 'placeholder' => 'Mr.','options' => GENDERS, 'validations' => ["notEmpty", "validOption"]],
    'Name'  => ['label' => 'Full Name', 'type' => 'text', 'placeholder' => 'Full name', 'validations' => ["notEmpty", "onlyCharacters"]],
    'Email' => ['label' => 'Email', 'type' => 'text', 'placeholder' => 'Example@example.com', 'validations' => ["notEmptyIf:CommunicationPreference:Email", "validEmail"]],
    'Phonenumber' => ['label' => 'Phone Number', 'type' => 'text', 'placeholder' => '0612345678', 'validations' => ["notEmptyIf:CommunicationPreference:Phone", "validPhoneNumber"]],
    'Streetname' => ['label' => 'Streetname', 'type' => 'text', 'placeholder' => 'Streetname', 'validations' => ["notEmptyIf:CommunicationPreference:Mail", "onlyCharacters"]],
    'Housenumber' => ['label' => 'Nr + addition', 'type' => 'text', 'placeholder' => '123A01', 'validations' => ["notEmptyIf:CommunicationPreference:Mail", "validHouseNumber"]],
    'Zipcode' => ['label' => 'Zipcode', 'type' => 'text', 'placeholder' => '1234AB', 'validations' => ["notEmptyIf:CommunicationPreference:Mail", "validZipcode"]],
    'City' => ['label' => 'City', 'type' => 'text', 'placeholder' => 'City', 'validations' => ["notEmptyIf:CommunicationPreference:Mail", "onlyCharacters"]],
    'CommunicationPreference' => ['label' => 'Communication', 'type' => 'radio', 'placeholder' => 'Email', 'options' => COMMUNICATION_PREFERENCES, 'validations' => ["notEmpty", "validOption"]],
    'Message' => ['label' => 'Message', 'type' => 'textarea', 'placeholder' => 'Message', 'validations' => ["notEmpty"]]
]);

define("registerData",[
    'Name'  => ['label' => 'Full Name', 'type' => 'text', 'placeholder' => 'Full name', 'validations' => ["notEmpty", "onlyCharacters"]],
    'Email' => ['label' => 'Email', 'type' => 'text', 'placeholder' => 'Example@example.com', 'validations' => ["notEmpty", "validEmail", "uniqueEmail", "toLowerCase"]],
    'Password' => ['label' => 'Password', 'type' => 'password', 'placeholder' => 'Password', 'validations' => ["notEmpty", "minLength:8", "containsUppercase", "containsLowercase", "containsNumber", "containsSpecialChar"]],
    'ConfirmPassword' => ['label' => 'Confirm Password', 'type' => 'password', 'placeholder' => 'Confirm Password', 'validations' => ["matchesPassword"]]
        ]);

define("loginData",[
    'Email' => ['label' => 'Email', 'type' => 'text', 'placeholder' => 'Example@example.com', 'validations' => ["notEmpty", "loginValid", "toLowerCase", "emailExists"]],
    'Password' => ['label' => 'Password', 'type' => 'password', 'placeholder' => 'Password', 'validations' => []]
]);


function getFormData($form)
{
    switch($form){
    case "register":
        return registerData;
        break;

    case "login":
        return loginData;
        break;

    case "contact":
        return contactData;
        break;
        
    default:
        break;
    }
}

function createEmptyFormData($formDataName)
{
    $formResults;
    //fill an empty form so formBuilder has access to array offset
    foreach(GetFormData($formDataName) as $key => $metaData)
    {
        $formResults[$key] = ['value' => '', 'error' =>''];
    }
    return $formResults;
}
?>