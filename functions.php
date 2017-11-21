<?php
function renderTemplate($file, $vars) {
    if(file_exists($file)) {
        ob_start();

        extract($vars);
        include $file;

        return ob_get_clean();
    }
}

function formatTime($ts) {
    $secondsPassed = strtotime('now') - $ts;
    $hoursPassed = $secondsPassed / 3600;
    $minutesPassed = $secondsPassed / 60;

    if ($hoursPassed >= 24) {
        return date("d.m.Y \в H:i", $ts);
    } else if ($hoursPassed >= 1) {
        return floor($hoursPassed) . " часов назад";
    } else if ($minutesPassed >= 1) {
        return floor($minutesPassed) . " минут назад";
    } else {
        return "только что";
    }
}