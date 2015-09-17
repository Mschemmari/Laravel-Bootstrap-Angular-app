<?php
function is_active($route, $class = 'active')
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (Request::is($r)) {
                return $class;
            }
        }

        return '';
    }

    return Request::is($route) ? $class : '';
}