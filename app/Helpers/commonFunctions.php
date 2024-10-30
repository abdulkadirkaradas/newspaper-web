<?php

use Carbon\Carbon;

if (!function_exists('convertUTCDateToLocalDate')) {
    function convertUTCDateToLocalDate($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}

if (!function_exists('render_page')) {
    function render_page($view, $data = [])
    {
        if (view()->exists($view)) {
            return view($view, $data)->render();
        }

        return [
            "message" => "Page doesn't exists"
        ];
    }
}