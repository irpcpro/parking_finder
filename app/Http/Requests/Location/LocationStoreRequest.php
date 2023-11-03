<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class LocationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'title' => ['string', 'required', 'max:' . LENGTH_LOCATION_INFO_TITLE],
            'description' => ['string', 'nullable', 'max:' . LENGTH_LOCATION_INFO_DESCRIPTION]
        ];
    }

    public function messages()
    {
        return [
            'lat.required' => Lang::get('msg.location.rule.lat.required'),
            'lat.regex' => Lang::get('msg.location.rule.lat.regex'),
            'long.required' => Lang::get('msg.location.rule.long.required'),
            'long.regex' => Lang::get('msg.location.rule.long.regex'),
            'title.required' => Lang::get('msg.location.rule.title.required'),
            'title.string' => Lang::get('msg.location.rule.title.string'),
            'title.max' => Lang::get('msg.location.rule.title.max'),
            'description.string' => Lang::get('msg.location.rule.description.string'),
            'description.max' => Lang::get('msg.location.rule.description.max'),
        ];
    }

}
