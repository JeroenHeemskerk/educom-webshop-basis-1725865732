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
        $housenumber = $zipcode = $city = $communcationPrefence = $message = "";
        $titleErr = $nameErr = $emailErr = $phonenumberErr = $streetnameErr = 
        $housenumberErr = $zipcodeErr = $cityErr = $communcationPrefenceErr = $messageErr = "";
        $valid = false;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // validate the 'POST' data
            $title = $_POST['title'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $streetname = $_POST['streetname'];
            $housenumber = $_POST['housenumber'];
            $zipcode = $_POST['zipcode'];
            $city = $_POST['city'];
            $communcationPrefence = $_POST['communcationPrefence'];
            $message = $_POST['message'];

            switch($communcationPrefence)
            {
                case "email":
                    if(empty($email))
                    {
                        $emailErr = "Email is required";
                    }
                    break;
                case "phone":
                    if(empty($phonenumber))
                    {
                        $phonenumberErr = "Phone number is required";
                    }
                    break;
                case "mail":
                    if(empty($streetname))
                    {
                        $streetnameErr = "Street name is required";
                    }
                    if(empty($housenumber))
                    {
                        $housenumberErr = "House number is required";
                    }
                    if(empty($zipcode))
                    {
                        $zipcodeErr = "Zip code is required";
                    }
                    if(empty($city))
                    {
                        $cityErr = "City is required";
                    }
                    break;
                }
                if(empty($name))
                {
                    $nameErr = "Name is required";
                }
                if(empty($message))
                {
                    $messageErr = "Message is required";
                }

                $valid = empty($nameErr) && empty($emailErr) && empty($phonenumberErr) && empty($streetnameErr) 
                        && empty($housenumberErr) && empty($zipcodeErr) && empty($cityErr) && empty($messageErr); 
         }
    ?>

    <?php if(!$valid){?>
    <form method="POST">
        <fieldset>

            <!-- Form Name -->
            <legend>Contact us</legend>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="control-label" for="title">Title</label>
                <select id="title" name="title">
                    <option value="Mr">Mr.</option>
                    <option value="Mrs" <?php if($title == "Mrs"){?>selected<?php }?>>Mrs</option>
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
                <label class="control-label" for="communcationPrefence">Communication</label>
                <label for="communcationPrefence-0">
                    <input type="radio" name="communcationPrefence" id="communcationPrefence-email" value="email"
                        checked="checked">
                    Email
                </label>
                <div class="radio">
                    <label for="communcationPrefence-1">
                        <input type="radio" name="communcationPrefence" id="communcationPrefence-phone" value="phone"
                        <?php if($communcationPrefence == "phone"){?>checked="checked"<?php }?>>
                        Phone
                    </label>
                </div>
                <div class="radio">
                    <label for="communcationPrefence-2">
                        <input type="radio" name="communcationPrefence" id="communcationPrefence-mail" value="mail"
                        <?php if($communcationPrefence == "mail"){?>checked="checked"<?php }?>>
                        Mail
                    </label>
                </div>
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
        Communication preference: <?php echo $communcationPrefence?><br>
        Message: <?php echo $message?><br>
        
    <?php
    }    
    ?>
</body>
<footer>
    &copy 2024 Jochem Grootherder
</footer>

</html>