<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class AdsBlock extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.ads_block', [
            'config' => $this->config,
        ]);
    }
}
