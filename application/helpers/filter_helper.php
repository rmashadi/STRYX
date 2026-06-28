<?php
if (!function_exists('filter')) {
        function filter($str) {
            $filter = preg_replace("~[%\/!*?'<>|]~\"", "", $str);
            return $filter;
        }
}


