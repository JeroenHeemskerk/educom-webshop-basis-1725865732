<?php

function showFormField($key, $metaData, $formResult)
{
    switch($metaData['type'])
    {
        case 'text':
            echo '
            <div class="form-group">
            <label class="control-label">'.$metaData['label'].'</label>
            <input class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" value="'.$formResult['value'].'"></input>';
            if(!empty($formResult['error']))
            {
                echo '<span class="error">* '.$formResult['error'].'</span>';
            }
            echo '
            </div>';
        break;
        case 'textarea':
            echo '
            <div class="form-group">
            <label class="control-label">'.$metaData['label'].'</label>
            <textarea class="form-control" name="'.$key.'" placeholder= "'.$metaData['placeholder'].'" ">'.$formResult['value'].'</textarea>';
            if(!empty($formResult['error']))
            {
                echo '<span class="error">* '.$formResult['error'].'</span>';
            }
            echo '
            </div>';
        break;
        case'select':
            echo '
            <div class="form-group">
            <label class="control-label">'.$metaData['label'].'</label>
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
            if(!empty($formResult['error']))
            {
                echo '<span class="error">* '.$formResult['error'].'</span>';
            }
            echo '
            </div>';
        break;
        case 'radio':
            
            echo '
            <div class="form-group">
            <label class="control-label">'.$metaData['label'].'</label>';
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
            if(!empty($formResult['error']))
            {
                echo '<span class="error">* '.$formResult['error'].'</span>';
            }
            echo '
            </div>';
        break;
        default:
        break;
    }

}


function openForm($target, $legend)
{
    echo '
    <form method="POST" action="index.php?">
        <fieldset>
            <input type="hidden" name="page" value="'.$target.'">
            <legend>'.$legend.'</legend>';
}

function closeForm()
{
    echo'
            <div class="form-group">
                <label class="control-label" for="send"></label>
                <button name="send" class="btn btn-primary">Send</button>
            </div>
        </fieldset>
    </form>';
}
?>