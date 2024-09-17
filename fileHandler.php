<?php
define("userFile", "users.txt");
function writeUserToFile($email, $name, $password)
{
    $myFile = fopen(userFile, "a") or die("Unable to open file!");
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
    $user = ["Email" => '', "Name" => '', "Password" => ''];
   
    if(file_exists(userFile)) 
    { 
        $fileHandle = fopen(userFile, "r");

        foreach(getAllLines($fileHandle) as $line)
        {
            $userData = explode("|", $line, 3);
            if($userData[0] === $email)
            {
                $user['Email'] = trim($userData[0]);
                $user['Name'] = trim($userData[1]);
                $user['Password'] = trim($userData[2]);
                fclose($fileHandle);
                return $user;
            }
        }
    }
    return $user;
}

function userExists($email)
{
    if(file_exists(userFile)) 
    { 
        $fileHandle = fopen(userFile, "r");

        foreach(getAllLines($fileHandle) as $line)
        {
            $userData = explode("|", $line, 3);
            if($userData[0] === $email)
            {
                return true;
            }
        }
    }
    return false;
}

?>