<?php

/*
server: (check pw)
_href, _type (open, close), timestamp, agent, username, userid, ip
*/

include('../settings.php');

// _timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,

// Create DB if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS $tblname(
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    _href TEXT NULL,
    _type VARCHAR(6),
    _agent TEXT NULL,
    _username TEXT NULL,
    _userid TEXT NULL,
    _timestamp DATE DEFAULT (datetime('now','localtime')),
    _ip TEXT NULL
)");
