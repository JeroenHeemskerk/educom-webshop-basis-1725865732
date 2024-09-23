<?php
define("USERFILE", "users.txt");
function writeUserToFile($email, $name, $password)
{
    $myFile = fopen(USERFILE, "a") or die("Unable to open file!");
    fwrite($myFile, $email. "|". $name. "|". $password. PHP_EOL);
    fclose($myFile);
}

function getAllLines($fileHandle)
{
    while(!feof($fileHandle))
    {
        yield fgets($fileHandle);
    }
}

function getUserFromFile($email)
{
    if(empty($email) || !file_exists(USERFILE))
    {
        return NULL;        
    }

    try
    {
        $fileHandle = fopen(USERFILE, "r");
        $user = NULL;
        foreach(getAllLines($fileHandle) as $line)
        {
            $userData = explode("|", $line, 3);
            if($userData[0] === $email)
            {
                $user = [
                "Email" => trim($userData[0]), 
                "Name" => trim($userData[1]), 
                "Password" => trim($userData[2])
                ];
                break;
            }
        }
    }
    catch   (\Exception $e)
    {

    }
    finally
    {
        fclose($fileHandle);
    }    
    return $user;
}

function userExists($email)
{
    return !empty(getUserFromFile($email));
}

?>