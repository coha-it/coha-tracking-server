<?php

/*
tools tracking

client
{} + pw

*/

function getIp () {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


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


// Create Table if not exist
// Create DB if it doesn't exist
$db = new SQLite3(__DIR__.'/storage/database24122314.sqlite');
$tblname = 'tracker';

$db->exec("CREATE TABLE IF NOT EXISTS $tblname(
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    _href TEXT NULL,
    _type VARCHAR(6),
    _agent TEXT NULL,
    _username TEXT NULL,
    _userid TEXT NULL,
    _timestamp DATE DEFAULT (datetime('now','localtime')),
    _last_ping DATE DEFAULT (datetime('now','localtime')),
    _ip TEXT NULL
)");

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
		_last_ping,
                _ip
            ) VALUES (
                '$_href', 
                '$_type',
                '$_agent',
                '$_username',
                '$_userid',
                '$_timestamp',
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

