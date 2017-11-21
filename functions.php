<?php

function renderTemplate ($template_path, $data) {
    if(is_file($template_path)) {
        foreach($data as $key => $value) {
            ${$key} = $value;
        }
        ob_start();
        require_once($template_path);
        return ob_get_clean();        
        } else {
            return '';
        }
};

function get_past_time ($timestamp) {
    $time_past = time() - $timestamp;
    if ($time_past >= 86400) {
        return date('d.m.y в H:i', $timestamp);
    } elseif ($time_past < 3600) {
        return (string)floor($time_past / 60) . ' минут назад'; 
    } else {
        return (string)floor($time_past / 3600) . ' часов назад';
    }
};

function validateNumber($value) {
    return filter_var($value, FILTER_VALIDATE_FLOAT);
};
 ?>