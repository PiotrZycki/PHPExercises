<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage
{
    public function store(Distinguishable $dis): void
    {
        $ser= serialize($dis);
        file_put_contents(Directory::storage(). $dis->key(), $ser);
    }

    public function loadAll(): array
    {
        $dis = [];
        $files = scandir(Directory::storage());
        if($files)
        {
            foreach ($files as $f)
            {
                $a = explode('/', $f);
                if(!str_contains($a[sizeof($a)-1], '.'))
                {
                    $text = (string) file_get_contents(Directory::storage().$f);
                    $unser = unserialize($text);
                    if(is_object($unser) && get_parent_class($unser) && get_parent_class($unser) == "Widget\Widget")
                    {
                        $dis[] = $unser;
                    }
                }
            }
        }
        return $dis;
    }
}