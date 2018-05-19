<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\TkReport;

class TkReportDimmer extends AbstractWidget
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
        $count = TkReport::count();
        $string = trans_choice('调研报告', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-documentation',
            'title'  => "{$count} {$string}",
            'text'   => __('您有 :count :string 在数据库中。点击下面的按钮查看所有报告。', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => "查看所有报告",
                'link' => route('voyager.tk-reports.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }
}
