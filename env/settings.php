<?php

const DB_DRIVER = 'mysql';
//DB constants
const DB_HOST = "localhost";
const DB_NAME = 'online-store';
const DB_USER = 'root';
const DB_USER_PASS = '';

//Template constants
const CONTENT_PLACE_HOLDER = '{{{CONTENT_HERE}}}';

const NATIVE = 'native';
const TWIG = 'twig';
const LIST_OF_TEMPLATE_ENGINES = [
    NATIVE => true,
    TWIG => false
];