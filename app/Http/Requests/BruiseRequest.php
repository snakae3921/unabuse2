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
//        logger('this is rules');    
        return [
            //
            'userid'        => 'required | string | max:100',
            'target'        => 'nullable | string | max:100',
            'age'           => 'nullable | numeric | between:0,99',
            'sex'           => 'nullable | numeric | between:0,2',
//            'hasseiyy'      => 'nullable | numeric | between:2010,2020',
            'hasseiyy'      => 'nullable | numeric',
//            'hasseimm'      => 'nullable | numeric | between:1,12',
            'hasseimm'      => 'nullable | numeric',
//            'hasseidd'      => 'nullable | numeric | between:1,31',
            'hasseidd'      => 'nullable | numeric',
            'hasseihh'      => 'nullable | numeric | between:0,23',
            'hasseimi'      => 'nullable | numeric | between:0,59',
            'factor'        => 'nullable | string | max:125',
            'element'       => 'nullable | numeric | between:0,15',
            'targetfile'    => 'nullable | string | max:125',
            'note'          => 'nullable | string  | max:125',
            'file1'         => 'nullable | image',
            'oimagename1'   => 'nullable | string',
            'takeymd1'      => 'nullable | string | max:125',
            'file2'         => 'nullable | image',
            'oimagename2'   => 'nullable | string',
            'takeymd2'      => 'nullable | string | max:125',
        ];
    }
}
