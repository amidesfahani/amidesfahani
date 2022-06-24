<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Amid\NovaToggle\Toggle;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Number;
use App\Nova\Files\OptimizeImages;
use Laravel\Nova\Http\Requests\NovaRequest;

class Skill extends Resource
{
    public static $group = 'Profile';
    public static $orderBy = ['grouporder' => 'asc', 'displayorder' => 'asc', 'id' => 'asc'];

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static $priority = 5;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Skill::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'title_fa'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Skills');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Skill');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Avatar::make(__('Logo'), 'image')
                ->disableDownload()->disk('public')->path('skills')
                ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                ->store(new OptimizeImages())
            ,

            Text::make(__('Title'), 'title')->rules('required'),

            (new Panel(__('Farsi'), [
                Text::make(__('Title'), 'title_fa')->hideFromIndex()->rtl(),
            ])),

            Number::make(__('Value'), 'power')->min(0)->max(100)->step(1)->required()->default(0),
            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
            Number::make(__('Group Order'), 'grouporder')->min(0)->max(99)->step(1)->required()->default(0),
            Toggle::make(__('Public'), 'public')->default(1)->inlineOnDetail()->inlineOnIndex(),
            Toggle::make(__('Active'), 'active')->default(1)->inlineOnDetail()->inlineOnIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
