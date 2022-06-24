<?php

namespace App\Nova;

use Amid\NovaToggle\Toggle;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\MorphTo;
use App\Nova\Files\OptimizeImages;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Imageable extends Resource
{
    public static $group = 'Data Tables';

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = true;

    /**
     * Indicates if the resource should be globally searchable.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Imageable::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            MorphTo::make('Imageable')->types([
                Education::class, Project::class
            ])->searchable(),
            Text::make(__('Title'), 'title')->rules('required')->ltr(),

            (new Panel(__('Farsi'), [
                Text::make(__('Title'), 'title_fa')->rtl(),
            ])),

            Image::make(__('Image'), 'image')
                ->disableDownload()->disk('public')->path('images')
                ->creationRules('required', 'image', 'max:10240')->maxWidth(100)->prunable()
                ->store(new OptimizeImages())
            ,

            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
            Toggle::make(__('Cover'), 'cover')->default(0)->inlineOnIndex()->inlineOnDetail()
        ];

        // $table->morphs('imageable');
        // $table->string('image');
        // $table->string('title')->nullable();
        // $table->string('title_fa')->nullable();
        // $table->smallInteger('displayorder')->default(0);
        // $table->boolean('cover')->default(false);
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
