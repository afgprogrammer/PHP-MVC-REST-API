<?php
function clean($data) {
    return trim(htmlspecialchars($data, ENT_COMPAT, 'UTF-8'));
}

function cleanUrl($url) {
    return str_replace(['%20', ' '], '-', $url);
}
