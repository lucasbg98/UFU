<?php

interface CRUD {
    public static function create($args);
    public static function read($args);
    public static function update($args);
    public static function delete($args);
}