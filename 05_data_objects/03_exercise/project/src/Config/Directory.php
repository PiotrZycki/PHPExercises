<?php

namespace Config;

class Directory
{
    private static string $root;

    public static function set(string $root): void
    {
        Directory::$root = $root;
    }

    public static function root(): string
    {
        return Directory::$root;
    }

    public static function storage(): string
    {
        return Directory::root() . "storage/";
    }
}
