<?php

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