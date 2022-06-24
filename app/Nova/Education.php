<?php

namespace App\Nova;

use Amid\NovaToggle\Toggle;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Files\OptimizeImages;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Education extends Resource
{
    public static $group = 'Profile';
    public static $orderBy = ['displayorder' => 'asc', 'id' => 'asc'];

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static $priority = 3;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Education::class;

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
        return __('Educations');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Education');
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

            Text::make(__('Title'), 'title')->rules('required'),
            Text::make(__('Field of study'), 'field')->hideFromIndex(),
            Avatar::make(__('Image'), 'image')
                ->disableDownload()->disk('public')->path('educations')
                ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                ->store(new OptimizeImages())
            ,
            Textarea::make(__('Description'), 'description'),
            Date::make(__('Start'), 'start_date')->rules(['nullable', 'date'])->nullable(),
            Date::make(__('End'), 'end_date')->rules(['nullable', 'date', 'after_or_equal:start_date'])->nullable(),

            (new Panel(__('Farsi'), [
                Text::make(__('Title'), 'title_fa')->rtl()->hideFromIndex(),
                Text::make(__('Field of study'), 'field_fa')->rtl()->hideFromIndex(),
                Image::make(__('Image'), 'image_fa')
                    ->disableDownload()->disk('public')->path('educations')
                    ->creationRules('nullable', 'image', 'max:10240')->maxWidth(100)->deletable()->prunable()
                    ->store(new OptimizeImages())->hideFromIndex()
                ,
                Textarea::make(__('Description'), 'description_fa'),
            ])),

            Number::make(__('Display Order'), 'displayorder')->min(0)->max(99)->step(1)->required()->default(0),
            Toggle::make(__('Active'), 'active')->default(true),

            MorphMany::make(__('Documents'), 'documents', Imageable::class),
        ];
    }
}
