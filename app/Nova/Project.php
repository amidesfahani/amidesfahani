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
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Project extends Resource
{
    public static $group = 'Projects';
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
    public static $model = \App\Models\Project::class;

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
            Text::make(__('Subtitle'), 'subtitle')->hideFromIndex(),
            Avatar::make(__('Image'), 'image')
                ->disableDownload()->disk('public')->path('projects')
                ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                ->store(new OptimizeImages())
            ,
            Textarea::make(__('About'), 'about'),
            Trix::make(__('Description'), 'description'),
            Date::make(__('Start'), 'order_date')->firstDayOfWeek(1)->rules(['nullable', 'date'])->nullable()->hideFromIndex(),
            Date::make(__('End'), 'final_date')->firstDayOfWeek(1)->rules(['nullable', 'date', 'after_or_equal:order_date'])->nullable()->hideFromIndex(),
            Text::make(__('Link'), 'link')->nullable()->hideFromIndex(),

            (new Panel(__('Farsi'), [
                Text::make(__('Title'), 'title_fa')->rtl()->hideFromIndex(),
                Text::make(__('Subtitle'), 'subtitle_fa')->rtl()->hideFromIndex(),
                Textarea::make(__('About'), 'about_fa'),
                Trix::make(__('Description'), 'description_fa'),
            ])),

            BelongsTo::make(__('Status'), 'status', Status::class)->nullable(),
            BelongsTo::make(__('Client'), 'client', Client::class)->searchable()->nullable()->hideFromIndex(),
            BelongsTo::make(__('City'), 'city', City::class)->searchable()->nullable()->hideFromIndex(),

            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
            Toggle::make(__('Active'), 'active')->default(true)->inlineOnIndex()->inlineOnDetail(),

            MorphMany::make(__('Images'), 'images', Imageable::class),
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
