<div class="qcmWrapper <?php $t = isset($trueStyle) ? $trueStyle : ''; echo $t?>">

<?php
        if(isset($score)) {
            echo '<h2 class="text-right text-info">score : '.$score['score'].'</h2>';
        }
        if(count($answer) === 1) {
            $type = 'radio';
        } else {
            $type = 'checkbox';
        }

        echo '<h3 class="query">'.$query.'</h3>
        <div class="form-wrapper">
        <form action="" method="POST">';

        foreach($form['value'] as $value) {
            $value = trim(strtolower($value));
            echo '
                <label><input type="'.$type.'" id="'.$form['id_prefix'].$value.'" name="choice[]" value="'.$value.'">'.$value.'</label><br>
            ';  
        } 

        echo ' <input type="submit" name="'.$form['submit'].'" class="btn btn-primary ml-0 mt-3 mb-3">
        </form> 
        </div>
        ';  
        if(isset($verdict)) {
            echo $verdict;
        }

        $current = isset($current) ? $current : '';
        
        echo "<a href='/play/question-$current' class='btn btn-info w-25 float-right' >next<i class='fa fa-caret-right ml-3' aria-hidden='true'></i></a>";
?>
</div>