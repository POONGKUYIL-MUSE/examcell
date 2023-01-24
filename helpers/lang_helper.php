<?php

function lang($slug) {
    $language = file_get_contents(__DIR__."/en_lang.json");
    $json_data = json_decode($language, true);

    return $json_data['english'][$slug];
}