<?php
include "defines.php";

global $COMMUNICATION_PREFERENCES;
global $GENDERS;
define("contactData" , [
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
]);

define("registerData",[
    'Username' => ['label' => 'Username', 'type' => 'text', 'placeholder' => 'Username', 'validations' => ["notEmpty", "minLength:5",]],
    'Password' => ['label' => 'Password', 'type' => 'password', 'placeholder' => 'Password', 'validations' => ["notEmpty", "minLength:8", "containsUppercase", "containsLowercase", "containsNumber", "containsSpecialChar"]],
    'ConfirmPassword' => ['label' => 'Confirm Password', 'type' => 'password', 'placeholder' => 'Confirm Password', 'validations' => ["notEmpty", "matchesField"]],
    'Gender' => ['label' => 'Gender', 'type' => 'select', 'placeholder' => 'Mr.','options' => $GENDERS, 'validations' => ["notEmpty", "validOption"]],
    'Name'  => ['label' => 'Full Name', 'type' => 'text', 'placeholder' => 'Full name', 'validations' => ["notEmpty", "onlyCharacters"]],
    'Email' => ['label' => 'Email', 'type' => 'text', 'placeholder' => 'Example@example.com', 'validations' => ["notEmptyIf:communication:Email", "validEmail"]],
    'Phonenumber' => ['label' => 'Phone Number', 'type' => 'text', 'placeholder' => '0612345678', 'validations' => ["notEmptyIf:communication:Phone", "validPhoneNumber"]]
]);

define("loginData",[
    'Username' => ['label' => 'Username', 'type' => 'text', 'placeholder' => 'Username', 'validations' => ["notEmpty", "minLength:5",]],
    'Password' => ['label' => 'Password', 'type' => 'password', 'placeholder' => 'Password', 'validations' => ["notEmpty", "minLength:8", "containsUppercase", "containsLowercase", "containsNumber", "containsSpecialChar"]]
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

?>