<?php
$DB_HOST = getenv('DB_HOST');
$DB_USER_NAME = getenv('DB_USER_NAME');
$DB_PASSWORD = getenv('DB_PASSWORD');
$DB_NAME = getenv('DB_NAME');


$db['db_host'] = empty($DB_HOST) ? 'localhost': $DB_HOST;
$db['db_user'] = empty($DB_USER_NAME) ? 'root': $DB_USER_NAME;
$db['db_pass'] = empty($DB_PASSWORD) ? '': $DB_PASSWORD;
$db['db_name'] = empty($DB_NAME) ? 'cms': $DB_NAME;

