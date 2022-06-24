<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Amid\NovaToggle\Toggle;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Files\OptimizeImages;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class History extends Resource
{
    public static $group = 'Profile';
    public static $orderBy = ['displayorder' => 'asc', 'id' => 'asc'];

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static $priority = 4;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\History::class;

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
        'id', 'title'
    ];

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
            Text::make(__('Title'), 'title')->rules('required'),
            Text::make(__('Role'), 'role')->hideFromIndex(),
            Avatar::make(__('Image'), 'image')
                ->disableDownload()->disk('public')->path('histories')
                ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                ->store(new OptimizeImages())
            ,
            Trix::make(__('Description'), 'description'),
            Date::make(__('Start'), 'start_date')->hideFromIndex(),
            Date::make(__('End'), 'end_date')->hideFromIndex(),
            Text::make(__('Link'), 'website')->hideFromIndex()->ltr(),

            (new Panel(__('Farsi'), [
                Text::make(__('Title'), 'title_fa')->rtl()->hideFromIndex(),
                Text::make(__('Role'), 'role_fa')->rtl()->hideFromIndex(),
                Trix::make(__('Description'), 'description_fa'),
            ])),

            Toggle::make(__('Present'), 'present')->default(false),

            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
            Toggle::make(__('Active'), 'active')->default(true),

            BelongsToMany::make(__('Testimonials'), 'testimonials', Testimonial::class)->searchable()
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
