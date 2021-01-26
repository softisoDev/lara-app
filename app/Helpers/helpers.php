<?php

function addSlash2Url($url)
{
    if ( !preg_match('/\/$/', $url) )
        return $url . '/';

    return $url;
}

function generateStatusBadge($status)
{

    if ( $status ) {
        return '<span class="badge badge-success">Active</span>';
    }

    return '<span class="badge badge-danger">Disabled</span>';
}

function statusSelect()
{
    return [
        1 => 'Active',
        0 => 'Disable',
    ];
}

function getLanguages($code = null)
{
    if ( is_null($code) ) {
        return config('languages');
    }

    if ( array_key_exists($code, config('languages')) ) {
        return config('languages')[$code];
    }
}

function get_property($data, $propertyName)
{
    if ( !is_object($data) )
        return null;

    return (property_exists($data, $propertyName)) ? $data->$propertyName : null;
}
