<?php
    function showHeader()
    {
        require 'header.html';
    }
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
            if(!empty($value))
            {
                if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $error = "Invalid email format. Expected: example@example.com";
                }  
            }
            break;
        
        case 'phonenumber':
        
            //0612345678
            //OR
            //+31612345678
            if(!empty($value))
            {
                //0612345678 
                //OR 
                //+31612345678 
                $pattern = match(strlen($value)) {
                    10 => '/06[0-9]{8}/', 
                    12 => '/[+]316[0-9]{8}/',
                    default => '' 
                }; 
            
                if (empty($pattern) || !preg_match($pattern, $value)) 
                {
                    $error = "Phonenumber has an invalid format. Expected format: '0612345678' or '+31612345678'"; 
                }   
                break; 
            }

        
        case 'zipcode':
            //1234AB
            if(!empty($value))
            {
                $value = strtoupper($value);
                $pattern = '/^[0-9]{4}[A-Z]{2}$/';
                if(!preg_match($pattern, $value))
                {
                    $error = "Zipcode has an invalid format. Expected format: '1234AB'";
                }
            }
            break;

        case 'housenumber':
            //123A01
            if(!empty($value))
            {
                $value = strtoupper($value);
                $pattern = '/^[0-9]+[A-Z]?[0-9]*$/';
                if(!preg_match($pattern, $value))
                {
                    $error = "Housenumber has an invalid format. Expected format: '[number][1 addition letter][addition number]'";
                }
            }
            break;

        case 'name':
            //only text
            if(empty($value))
            {
                $error = $key." is required";
            }
            else
            {

            $value = trim($value);
            $pattern = '/^(((\p{L}\p{M}*+)+)\s*)+$/u';
            if(!preg_match($pattern, $value))
            {
                $error = "Name can only contain letters and spaces";
            }
        }
            break;

        case 'city':
            //only text
            
            if(!empty($value))
            {
                $value = trim($value);
                $pattern = '/^(((\p{L}\p{M}*+)+)\s*)+$/u';
                if(!preg_match($pattern, $value))
                {
                    $error = "City can only contain letters and spaces";
                }
            }
            break;

        case 'streetname':
            //only text
            
            if(!empty($value))
            {
                $value = trim($value);
                $pattern = '/^(((\p{L}\p{M}*+)+)\s*)+$/u';
                if(!preg_match($pattern, $value))
                {
                    $error = "Streetname can only contain letters and spaces";
                }
            }
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
            //Remove unsafe characters (XSS)
            $value = htmlspecialchars($value, ENT_QUOTES);
            break;
    }
    }

    function getContactPostVar($key, &$error)
    {
        $value = getPostVar($key);
        validateData($key,$value, $error);
        return $value;
    }
    
    function showBody()
    {
        $title = $name = $email = $phonenumber = $streetname = 
        $housenumber = $zipcode = $city = $communicationPreference = $message = "";
        
        $titleErr = $nameErr = $emailErr = $phonenumberErr = $streetnameErr = 
        $housenumberErr = $zipcodeErr = $cityErr = $communicationPreferenceErr = $messageErr = "";
        
        $emailPreference = $phonePreference = $mailPreference = false;
        $validInput = false;
        $requiredInputFilled = false;
        $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate the 'POST' data
        $title = getContactPostVar('title', $titleErr);
        $name = getContactPostVar('name', $nameErr);
        $email = getContactPostVar('email', $emailErr);
        $phonenumber = getContactPostVar('phonenumber', $phonenumberErr);
        $streetname = getContactPostVar('streetname', $streetnameErr);
        $housenumber = getContactPostVar('housenumber', $housenumberErr);
        $zipcode = getContactPostVar('zipcode', $zipcodeErr);
        $city = getContactPostVar('city',  $cityErr);
        $communicationPreference = getContactPostVar('communicationPreference', $communicationPreferenceErr);
        $message = getContactPostVar('message', $messageErr);


        switch($communicationPreference)
        {
            case 'email':
                if(empty($email))
                {
                    $emailErr = 'email is required';
                }
                $requiredInputFilled = !empty($email);
                $validInput = empty($emailErr);
                break;
            case 'phone':
                if(empty($phonenumber))
                {
                    $phonenumberErr = 'phone number is required';
                }
                $requiredInputFilled = !empty($phonenumber);
                $validInput = empty($phonenumberErr);
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
                $validInput = empty($streetnameErr) && empty($housenumberErr) && empty($zipcodeErr) && empty($cityErr);
                break;
                default:
                    $requiredInputFilled = false;
                break;
        }
        $validInput = empty($titleErr) && empty($nameErr) && empty($emailErr) && empty($phonenumberErr) && 
                    empty($streetnameErr) && empty($housenumberErr) && empty($zipcodeErr) && empty($cityErr) &&
                    empty($communicationPreferenceErr) && empty($messageErr);
        
        $valid = $validInput && $requiredInputFilled;

        }?>

    <?php 
    if(!$valid){?>
    <form method="POST" action="index.php?">
        <fieldset>
        <input type="hidden" name="page" value="contact.php">

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
    
    function showFooter()
    {
        include 'footer.html';
    }

}
    ?>