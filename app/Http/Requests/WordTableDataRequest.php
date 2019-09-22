<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordTableDataRequest extends FormRequest
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

    private $allowSortColumns = [
      "name",
      "freq",
    ];

    private $allowOrder = [
        "asc",
        "desc"
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->column && !in_array($this->column, $this->allowSortColumns)){
                $validator->errors()->add('column', 'Столбец не найден');
            }
            if($this->order && !in_array($this->order, $this->allowOrder)){
                $validator->errors()->add('sort', 'Такой метод сортировки запрещен');
            }
        });
    }
}
