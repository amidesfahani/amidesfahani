<?php

namespace App\Nova;

use Amid\NovaToggle\Toggle;
use Laravel\Nova\Panel;
use App\Rules\ValidMobile;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Password;
use App\Nova\Files\FitOptimizedImages;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;

class User extends Resource
{
    public static $group = 'Users';
    public static $orderBy = ['id' => 'asc'];

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
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'email';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'firstname', 'lastname', 'email', 'mobile', 'firstname_fa', 'lastname_fa'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('User');
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->fullname;
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
            ID::make()->sortable(),

            Avatar::make(__('Avatar'), 'avatar')->disableDownload()
                ->disk('public')->path('avatars')
                ->creationRules('nullable', 'image', 'max:10240')
                ->maxWidth(100)->deletable()->prunable()
                ->store(new FitOptimizedImages()),

            Text::make(__('Name'), function () {
                return $this->name;
            })->onlyOnIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('Firstname'), 'firstname')->rules('required')->hideFromIndex(),
            Text::make(__('Lastname'), 'lastname')->rules('required')->hideFromIndex(),

            (new Panel(__('Farsi'), [
                Text::make(__('Firstname'), 'firstname_fa')->hideFromIndex()->rtl(),
                Text::make(__('Lastname'), 'lastname_fa')->hideFromIndex()->rtl(),
            ])),

            Text::make(__('Mobile'), 'mobile')
                ->rules('required', 'max:12', new ValidMobile)
                ->creationRules('unique:users,mobile')
                ->updateRules('unique:users,mobile,{{resourceId}}')->ltr(),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            
            Date::make(__('Birthdate'), 'birthdate')->hideFromIndex(),
            
            // NovaPersianDate::make(__('Birthdate'), 'birthdate')
            //     ->format('jYYYY-jMM-jDD')
            //     ->min(Jalalian::now()->subYears(100)->format('Y-m-d'))
            //     ->max(Jalalian::now()->subYears(7)->format('Y-m-d'))
            //     ->humanize()->type('date')->editable()
            //     ->sortable()->hideFromIndex(),
            
            Select::make(__('Gender'), 'gender')->options([
                'male' => __('Male'),
                'female' => __('Female'),
                'not' => __('Prefer not to say'),
            ])->displayUsingLabels()->default('not')->onlyOnDetail(),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            
            Toggle::Make(__('Available'), 'available')->default(1)->inlineOnDetail()->inlineOnIndex(),
            
            HasMany::make(__('Profiles'), 'profiles', Profile::class)
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
