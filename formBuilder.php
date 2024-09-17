<?php

function showFormField($key, $metaData, $formResult)
{
    echo '
    <div class="form-group">
    <label class="control-label">'.$metaData['label'].'</label>';
    switch($metaData['type'])
    {
        case 'text':
            echo '
            <input class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" value="'.$formResult['value'].'"></input>';
        break;
        case 'textarea':
            echo '
            <textarea class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" ">'.$formResult['value'].'</textarea>';
        break;
        case'select':
            echo '
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
        break;
        case 'radio':
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
        break;
        case 'password':
            echo '
            <input class="form-control" type="password" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" value="'.$formResult['value'].'"></input>';
            if(!empty($formResult['error']))
            {
                echo '<span class="error">* '.$formResult['error'].'</span>';
            }
        break;
        default:
        break;
    }
    
    if(!empty($formResult['error']))
    {
        echo '<span class="error">* '.$formResult['error'].'</span>';
    }
    echo '</div>';

}


function openForm($target, $legend)
{
    echo '
    <form method="POST" action="index.php?">
        <fieldset>
            <input type="hidden" name="page" value="'.$target.'">
            <legend>'.$legend.'</legend>';
}

function closeForm($buttonText)
{
    echo'
            <div class="form-group">
                <label class="control-label" for="send"></label>
                <button name="send" class="btn btn-primary">'.$buttonText.'</button>
            </div>
        </fieldset>
    </form>';
}
?>