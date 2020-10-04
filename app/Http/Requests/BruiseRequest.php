<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BruiseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        logger('this is rules');    
        return [
            //
            'userid'        => 'required | string | max:100',
            'target'        => 'required | string | max:100',
            'age'           => 'nullable | numeric | between:0,99',
            'sex'           => 'nullable | numeric | between:1,2',
            'hasseiyy'      => 'nullable | numeric | between:2000,2040',
            'hasseimm'      => 'nullable | numeric | between:1,12',
            'hasseidd'      => 'nullable | numeric | between:1,31',
            'hasseihh'      => 'nullable | numeric | between:0,24',
            'hasseimi'      => 'nullable | numeric | between:0,59',
            'factor'        => 'nullable | string',
            'element'       => 'nullable | numeric | between:1,15',
            'targetfile'    => 'nullable | string ',
            'note'          => 'nullable | string ',
            'image1'        => 'nullable | image',
            'oimagename1'   => 'nullable | string',
            'takeymd1'      => 'nullable | string',
            'image2'        => 'nullable | image',
            'oimagename2'   => 'nullable | string',
            'takeymd2'      => 'nullable | string',
        ];
    }
}
