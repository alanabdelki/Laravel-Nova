<?php

namespace App\Nova;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class IdentityInformation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\IdentityInformation>
     */
    public static $model = \App\Models\IdentityInformation::class;

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('user'),
            Select::make('military services')->options(['exempt' => 'exempt',
                'performer' => 'performer',
                'deferred' => 'deferred',
                'fixed services' => 'fixed_services',
                'money instead of service' => 'money_instead_of_service'])->rules('nullable'),
            Text::make('reason of exempt') ->dependsOn(
                ['military_services'],
                function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->military_services=='exempt') {
                        $field->show();
                    } else {
                        $field->hide();
                    }
                }
            )->hideFromDetail(function ($request) {
                return $this->value === null;
            }),
            Text::make('nationality')->rules('nullable')
        ];
    }
    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
