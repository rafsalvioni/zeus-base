<?php

foreach ((array)glob(__DIR__ . DIRECTORY_SEPARATOR . '_*.php') as $file) {
    require $file;
}