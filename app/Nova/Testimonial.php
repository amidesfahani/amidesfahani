<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Files\FitOptimizedImages;
use Laravel\Nova\Http\Requests\NovaRequest;

class Testimonial extends Resource
{
    // public static $group = 'Users';
    public static $orderBy = ['displayorder' => 'asc', 'id' => 'asc'];

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static $priority = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Testimonial::class;

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
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Testimonials');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Testimonial');
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
            Text::make(__('Language'), 'language'),
            Text::make(__('Title'), 'title')->rules('required'),
            Text::make(__('Subtitle'), 'subtitle'),
            Textarea::make(__('Description'), 'description')->rules('required'),
            Avatar::make(__('Image'), 'image')
                ->disableDownload()->disk('public')->path('testimonials')
                ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                ->store(new FitOptimizedImages())
            ,
            Number::make(__('Stars'), 'stars')->min(0)->max(5)->step(1)->required()->default(0),
            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
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
