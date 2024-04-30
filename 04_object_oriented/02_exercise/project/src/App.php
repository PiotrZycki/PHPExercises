<?php

use Widget\Widget;

class App
{
    public function run(): void
    {
        $widgets = [];
        $fStorage = new \Storage\FileStorage();
        for($i = 1; $i < 4; $i++) {
            $widgets[] = new \Widget\Link($i);
            $widgets[] = new \Widget\Button($i);
        }

        foreach($widgets as $w)
        {
            if($w instanceof Widget) {
                $fStorage->store($w);
            }
        }

        $loaded = $fStorage->loadAll();
        foreach($loaded as $l)
        {
            if($l instanceof Widget)
            {
                $this->render($l);
            }
        }
    }

    private function render(Widget $widget): void
    {
        $widget->draw();
    }
}
