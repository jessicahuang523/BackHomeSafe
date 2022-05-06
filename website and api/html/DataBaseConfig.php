<?php

class DataBaseConfig
{
    public $servername;
    public $username;
    public $password;
    public $databasename;

    public function __construct()
    {

        $this->servername = 'us-cdbr-east-05.cleardb.net';
        $this->username = 'b6b7e26fb07b57';
        $this->password = 'cadfa54a';
        $this->databasename = 'heroku_7c19d9f37317a8a';

    }
}
