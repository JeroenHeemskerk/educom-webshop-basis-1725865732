<?php
include "defines.php";
function validateField($key, $metaData, &$formResults)
    {
        global $COMMUNICATION_PREFERENCES;
        global $GENDERS;
        foreach($metaData['validations'] as $validation)
        {
            $parts = explode(':', $validation, 2);
            switch ($parts[0]){
                case 'notEmpty':
                    if(empty($formResults[$key]['value']))
                    {
                        $formResults[$key]['error'] = $key .' can not be empty';
                    }
                    break;
                case 'validOption':
                    switch ($key)
                    {
                        case 'communicationPreference':
                            if(!in_array($formResults[$key]['value'], $COMMUNICATION_PREFERENCES))
                            {
                                $error_string = "";
                                foreach($COMMUNICATION_PREFERENCES as $communication_method)
                                {
                                    $error_string.= '"'.$communication_method.'" ';
                                }
                                $formResults[$key]['error'] = $key .' must be either:'.$error_string;
                            }
                            break;

                        case 'gender':
                            if(!in_array($formResults[$key]['value'], $GENDERS))
                            {
                                $error_string = "";
                                foreach($GENDERS as $GENDER)
                                {
                                    $error_string.= '"'.$GENDER.'" ';
                                }
                                $formResults[$key]['error'] = $key .' must be either:'.$error_string;

                            }
                            break;
                    }
                    break;
                case 'onlyCharacters':
                    if(!empty($formResults[$key]['value']))
                    {
                        $formResults[$key]['value'] = trim($formResults[$key]['value']);
                        $pattern = '/^(((\p{L}\p{M}*+)+)\s*)+$/u';
                        if(!preg_match($pattern, $formResults[$key]['value']))
                        {
                            $formResults[$key]['error'] = $key." can only contain letters and spaces";
                        }
                    }
                    break;
                case 'notEmptyIf':
                    switch($parts[1])
                    {
                        case 'communication:Email':
                            if(empty($formResults[$key]['value']) && $formResults['CommunicationPreference']['value'] == 'Email')
                            {
                                $formResults[$key]['error'] = $key .' can not be empty';
                            }
                            break;
                        case 'communication:Phone':
                            if(empty($formResults[$key]['value']) && $formResults['CommunicationPreference']['value'] == 'Phone')
                            {
                                $formResults[$key]['error'] = $key .' can not be empty';
                            }
                            break;
                        case 'communication:Mail':
                            if(empty($formResults[$key]['value']) && $formResults['CommunicationPreference']['value'] == 'Mail')
                            {
                                $formResults[$key]['error'] = $key .' can not be empty';
                            }
                            break;
                    }
                    break;
                case 'validEmail':
                    if(!empty($formResults[$key]['value']))
                    {
                        if(!filter_var($formResults[$key]['value'], FILTER_VALIDATE_EMAIL))
                        {
                            $formResults[$key]['error'] = "Invalid Email format. Expected: example@example.com";
                        } 
                    } 
                    break;
                case 'validPhoneNumber':
                    if(!empty($formResults[$key]['value']))
                    {
                        //0612345678 
                        //OR 
                        //+31612345678 
                        $pattern = match(strlen($formResults[$key]['value'])) {
                            10 => '/06[0-9]{8}/', 
                            12 => '/[+]316[0-9]{8}/',
                            default => '' 
                        }; 
                    
                        if (empty($pattern) || !preg_match($pattern, $formResults[$key]['value'])) 
                        {
                            $formResults[$key]['error'] = "Phonenumber has an invalid format. Expected format: '0612345678' or '+31612345678'"; 
                        } 
                    }  
                    break;
                case 'validZipcode':
                    
                if(!empty($formResults[$key]['value']))
                {
                    $value = strtoupper($formResults[$key]['value']);
                    $pattern = '/^[0-9]{4}[A-Z]{2}$/';
                    if(!preg_match($pattern, $value))
                    {
                        $formResults[$key]['error'] = "Zipcode has an invalid format. Expected format: '1234AB'";
                    }
                }
                    break;
                }
        }   
        return $formResults;
    }
?>