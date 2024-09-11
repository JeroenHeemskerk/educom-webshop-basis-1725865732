<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>

    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<header>
    <h1>My Webshop</h1>
    <ul class="nav-menu">
        <li class="nav-menu-item">
            <a href="index.html" class="menu-link">HOME</a>
        </li>
        <li class="nav-menu-item">
            <a href="about.html" class="menu-link">ABOUT</a>
        </li>
        <li class="nav-menu-item">
            <a href="contact.php" class="menu-link">CONTACT</a>
        </li>
    </ul>
</header>

<body>
<?php

    $title = $name = $email = $phonenumber = $streetname = 
    $housenumber = $zipcode = $city = $communicationPreference = $message = "";
    
    $titleErr = $nameErr = $emailErr = $phonenumberErr = $streetnameErr = 
    $housenumberErr = $zipcodeErr = $cityErr = $communicationPreferenceErr = $messageErr = "";
    
    $emailPreference = $phonePreference = $mailPreference = false;
    $validInput = false;
    $requiredInputFilled = false;
    $valid = false;

    function validateData($key, &$value, &$error)
    {
        switch ($key)
        {
        case 'title':
            if(!($value == 'Mr' || $value == 'Mrs'))
            {
                $error = $key." must be either Mr. or Mrs.";
            }
            break;

        case 'email':
            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                $error = "Invalid email format";
            }  
            break;
        
        case 'phonenumber':
        
            //TODO: VALIDATE PHONE NUMBER
            //0612345678
            //OR
            //+31612345678
            break;
        
        case 'zipcode':
            //TODO: VALIDATE ZIP CODE
            //1234AB
            break;

        case 'housenumber':
        
            //TODO: VALIDATE HOUSE NUMBER
            //123A
            break;

        case 'name':
            if(empty($value))
            {
                $error = $key." is required";
            }
            break;
            //todo: VALIDATE NAME
            //only text
        case 'city':
        case 'streetname':
            //TODO: VALIDATE CITY, STREETNAME
            //only text
            break;
        case 'communicationPreference':
            if(!($value == 'email' || $value == 'phone' || $value =='mail'))
            {
                $error = $key." must be either email, phone or mail";
            }
            break;
            
        case 'message':
            if(empty($value))
            {
                $error = $key." is required";
            }
            //TODO: VALIDATE MESSAGE
            //Remove unsafe characters (XSS)
            break;
    }
    }

    function getPostVar($key, &$error)
    {
        if(!isset($_POST[$key]))
        {
            return "";
        }
        $value = $_POST[$key];
        $value = trim($value);
        validateData($key,$value, $error);
        return $value;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate the 'POST' data
        $title = getPostVar('title', $titleErr);
        $name = getPostVar('name', $nameErr);
        $email = getPostVar('email', $emailErr);
        $phonenumber = getPostVar('phonenumber', $phonenumberErr);
        $streetname = getPostVar('streetname', $streetnameErr);
        $housenumber = getPostVar('housenumber', $housenumberErr);
        $zipcode = getPostVar('zipcode', $zipcodeErr);
        $city = getPostVar('city',  $cityErr);
        $communicationPreference = getPostVar('communicationPreference', $communicationPreferenceErr);
        $message = getPostVar('message', $messageErr);

        $requiredInputFilled = false;

        switch($communicationPreference)
        {
            case 'email':
                if(empty($email))
                {
                    $emailErr = 'email is required';
                }
                $requiredInputFilled = !empty($email);
                $valid = empty($emailErr);
                break;
            case 'phone':
                if(empty($phonenumber))
                {
                    $phonenumberErr = 'email is required';
                }
                $requiredInputFilled = !empty($phonenumber);
                $valid = empty($phonenumberErr);
                break;
            case 'mail':
                if(empty($streetname))
                {
                    $streetnameErr = 'streetname is required';
                }
                if(empty($housenumber))
                {
                    $housenumberErr = 'housenumber is required';
                }
                if(empty($zipcode))
                {
                    $zipcodeErr = 'zipcode is required';
                }
                if(empty($city))
                {
                    $cityErr = 'city is required';
                }
                $requiredInputFilled = !empty($streetname) && !empty($housenumber) && !empty($zipcode) && !empty($city);
                $valid = empty($streetnameErr) && empty($housenumberErr) && empty($zipcodeErr) && empty($cityErr);
                break;
        }
        $validInput = empty($titleErr) && empty($nameErr) && empty($emailErr) && empty($phonenumberErr) && 
                    empty($streetnameErr) && empty($housenumberErr) && empty($zipcodeErr) && empty($cityErr) &&
                    empty($communicationPreferenceErr) && empty($messageErr);
        
        $valid = $validInput && $requiredInputFilled;

        }?>

    <?php if(!$valid){?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>

            <!-- Form Name -->
            <legend>Contact us</legend>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="control-label" for="title">Title</label>
                <select id="title" name="title">
                <option value="Mr">Mr.</option>
                    <option value="Mrs" <?php if($title == "Mrs"){?>selected<?php }?>>Mrs.</option>
                </select>
                <?php if(!empty($titleErr)){?>
                    <span class="error">* <?php echo $titleErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="name">Full name</label>
                <input id="name" name="name" type="text" placeholder="Full name" class="form-control" value="<?php echo $name?>">  </input>

                <?php if(!empty($nameErr)){?>
                    <span class="error">* <?php echo $nameErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input id="email" name="email" type="text" placeholder="Example@email.com" class="form-control" value="<?php echo $email?>">

                <?php if(!empty($emailErr)){?>
                    <span class="error">* <?php echo $emailErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="phonenumber">Phone number</label>
                <input id="phonenumber" name="phonenumber" type="text" placeholder="+31612345678" class="form-control"
                 value="<?php echo $phonenumber?>">
                <?php if(!empty($phonenumberErr)){?>
                    <span class="error">* <?php echo $phonenumberErr; ?></span>
                <?php }?>

            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="streetname">Streetname</label>
                <input id="streetname" name="streetname" type="text" placeholder="Streetname" class="form-control" value="<?php echo $streetname?>">

                <?php if(!empty($streetnameErr)){?>
                    <span class="error">* <?php echo $streetnameErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="housenumber">nr. + addition</label>
                <input id="housenumber" name="housenumber" type="text" placeholder="123 a" class="form-control" value="<?php echo $housenumber?>">

                <?php if(!empty($housenumberErr)){?>
                    <span class="error">* <?php echo $housenumberErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="zipcode">zipcode</label>
                <input id="zipcode" name="zipcode" type="text" placeholder="1234AB" class="form-control" value="<?php echo $zipcode?>">

                <?php if(!empty($zipcodeErr)){?>
                    <span class="error">* <?php echo $zipcodeErr; ?></span>
                <?php }?>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="city">City</label>
                <input id="city" name="city" type="text" placeholder="City" class="form-control" value="<?php echo $city?>">

                <?php if(!empty($cityErr)){?>
                    <span class="error">* <?php echo $cityErr; ?></span>
                <?php }?>
            </div>

            <!-- Multiple Radios -->
            <div class="form-group">
                <label class="control-label" for="communicationPreference">Communication</label>
                <label for="communicationPreference-0">
                    <input type="radio" name="communicationPreference" id="communicationPreference-email" value="email"
                        checked="checked">
                    Email
                </label>
                <div class="radio">
                    <label for="communicationPreference-1">
                        <input type="radio" name="communicationPreference" id="communicationPreference-phone" value="phone"
                        <?php if($communicationPreference == "phone"){?>checked="checked"<?php }?>>
                        Phone
                    </label>
                </div>
                <div class="radio">
                    <label for="communicationPreference-2">
                        <input type="radio" name="communicationPreference" id="communicationPreference-mail" value="mail"
                        <?php if($communicationPreference == "mail"){?>checked="checked"<?php }?>>
                        Mail
                    </label>
                </div>
                <?php 
                if(!empty($communicationPreferenceErr)){?>
                    <span class="error">* <?php echo $communicationPreferenceErr; ?></span>
                <?php }?>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="control-label" for="message">Message</label>
                <textarea id="message" name="message" class="form-control" placeholder="Message"><?php echo $message?></textarea>

                <?php if(!empty($messageErr)){?>
                    <span class="error">* <?php echo $messageErr; ?></span>
                <?php }?>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="control-label" for="send"></label>
                <button id="send" name="send" class="btn btn-primary">Send</button>
            </div>

        </fieldset>
    </form>
    <?php 
    } 
    else
    {
    ?>
        Thank you for your message, we will be in contact soon. </br>
        Your details are: <br>
        Name: <?php echo $name?><br>
        Email: <?php echo $email?><br>
        Phone number: <?php echo $phonenumber?><br>
        Streetname: <?php echo $streetname?><br>
        House number + addition: <?php echo $housenumber?><br>
        Zipcode: <?php echo $zipcode?><br>
        City: <?php echo $city?><br>
        Communication preference: <?php echo $communicationPreference?><br>
        Message: <?php echo $message?><br>
        
    <?php
    }    
    ?>
</body>
<footer>
    &copy 2024 Jochem Grootherder
</footer>

</html>