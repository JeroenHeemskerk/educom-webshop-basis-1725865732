<?php
//formresult staan results in en moeten de errors in opgeslagen worden
//metaArray bevat de validatie methode
function validateField($key, $metaData, $formResults)
    {
        echo $formResults['communicationPreference']['value'];
        foreach($metaData['validations'] as $validation)
        {
            $parts = explode(':', $validation, 2);
            switch ($parts[0]){
                case 'notEmpty':
                    break;
                case 'validOption':
                    break;
                case 'onlyCharacters':
                    break;
                case 'notEmptyIf':
                    switch($parts[1])
                    {
                        case 'communication:email':
                            break;
                        case 'communication:phone':
                            break;
                        case 'communication:mail':
                            break;
                    }
                    break;
                case 'validEmail':
                    break;
                case 'validPhoneNumber':
                    break;
                case 'validZipcode':
                    break;
                }
        }   
        return $formResults;
    }
function checkEmpty($value)
{
    return empty($value);
}

?>