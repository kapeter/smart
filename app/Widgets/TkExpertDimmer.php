<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\TkExpert;

class TkExpertDimmer extends AbstractWidget
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
        $count = TkExpert::count();
        $string = trans_choice('专家', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => __('您有 :count :string 在数据库中。点击下面的按钮查看所有专家。', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => "查看所有专家",
                'link' => route('voyager.tk-experts.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }
}
