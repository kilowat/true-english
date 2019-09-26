<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Tags extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'model' => '',
        'route' => '',
        'current_tag' => '',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $model = new $this->config['model'];
        $tags_tmp = $model->existingTags();

        $tags = [];
        foreach($tags_tmp as $tag_item){
            $tags[] = [
                "tag" => $tag_item,
                "url" => route($this->config["route"], $tag_item->slug),
                "active" => $tag_item->slug == $this->config["current_tag"],
            ];
        }

        return view('widgets.tags', compact('tags'));
    }
}
