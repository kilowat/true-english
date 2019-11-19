<?php

namespace App\Http\Requests;

use App\Models\Grammar;
use App\Models\YoutubeChannelModel;
use Illuminate\Foundation\Http\FormRequest;

class YoutubeChannelPost extends FormRequest
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
            'code' => 'required',
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
            if (!$this->uniqueCode()) {
                $validator->errors()->add('code', 'Код должен быть уникальным');
            }
        });
    }

    private function uniqueCode()
    {
        $row = YoutubeChannelModel::where('code', '=', $this->code)->first();

        if(!$row) return true;

        if($this->id){//update
            if($this->code === YoutubeChannelModel::where('id', '=', $this->id)->first()->code){
                return true;
            }
        }

        return false;
    }
}
