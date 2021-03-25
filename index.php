<?php

/*
tools tracking

client
{} + pw

*/

include(__DIR__.'/scripts/settings.php');
include(__DIR__.'/scripts/functions.php');

// Check Request
if (!$_REQUEST) {
    return true;
}

// Variables
$_href      = $_REQUEST['_href'] ?? '';
$_type      = $_REQUEST['_type'] ?? '';
$_agent     = $_REQUEST['_agent'] ?? '';
$_username  = $_REQUEST['_username'] ?? '';
$_userid    = $_REQUEST['_userid'] ?? '';
$_ip        = getIp();

// Insert
$db->exec(
    "INSERT INTO $tblname(
        _href, 
        _type,
        _agent,
        _username,
        _userid,
        _ip
    ) VALUES (
        '$_href', 
        '$_type',
        '$_agent',
        '$_username',
        '$_userid',
        '$_ip'
    )"
);
