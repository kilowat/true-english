<?php

namespace App\Http\Requests;

use App\Models\WordSection;
use Illuminate\Foundation\Http\FormRequest;

class WordCollectionSectionPost extends FormRequest
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
        return [
            'name' => 'required',
            'code' => 'required'
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->uniqueCode()) {
                $validator->errors()->add('code', 'Должно быть уникальным');
            }
        });
    }

    private function uniqueCode(){
        $row = WordSection::where('id', '=', $this->id)->first();

        if($this->id > 0){
            return $row->code !== $this->code;
        }else{
            return $row;
        }
    }
}
