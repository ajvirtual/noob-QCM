<?php
    echo '<a href="/" class="btn btn-primary">home</a>';
    $score = isset($score) ? $score['score'] : '';
    echo '<h1 class="text-center">votre score final est : '.$score.'</h1>';