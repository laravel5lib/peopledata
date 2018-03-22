<?php

/**
 * @param $url
 * @param bool $removeExtension
 * @return string
 */
function cleanUrl($url, $removeExtension = false)
{
    $url = strtolower($url);
    $lastpoint = strrpos($url,".");

    $url = str_slug(substr($url,0,$lastpoint));
    if(!$removeExtension)$url .= substr($url,$lastpoint);
    return $url;
}