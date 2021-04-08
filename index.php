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
$_username  = $_REQUEST['_username'] ?? 'nousername';
$_userid    = $_REQUEST['_userid'] ?? '';
$_timestamp = date('Y-m-d H:i:s');
$_ip        = getIp();

function my_time() {
    return localtime();
}

$my_time = 'my_time';

// If Type is Open:
switch ($_type) {
    case 'open':
    case 'close':
        $db->exec(
            "INSERT INTO $tblname(
                _href, 
                _type,
                _agent,
                _username,
                _userid,
                _timestamp,
                _ip
            ) VALUES (
                '$_href', 
                '$_type',
                '$_agent',
                '$_username',
                '$_userid',
                '$_timestamp',
                '$_ip'
            )"
        );
        break;

    case 'ping':
        // echo "jo last ping set";
        $db->exec(
            "UPDATE $tblname
            SET _last_ping = '$_timestamp'
            WHERE _userid = '$_userid'
            AND _username = '$_username';"
        );
        break;

    default:
        # code...
        break;
}

// Insert

