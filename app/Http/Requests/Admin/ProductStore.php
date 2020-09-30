<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductStore extends FormRequest
{

  public function __construct()
  {
    parent::__construct();
    request()->request->add(request()->route()->parameters());
  }


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
      'categories' => ['required'],
      'name' => ['required'],
      'manufacturer' => ['required'],
      'article' => ['required', 'unique:product,article'],
      'meta_keywords' => ['required'],
      'meta_description' => ['required'],
      'meta_title' => ['required'],
      'available' => ['required'],
//      'weight' => [],
      'price' => ['required'],
//      'dimension' => [],
//      'comment' => [],
      'material' => ['required'],
      'technic' => ['required'],
//      'description' => [],
//      'video ' => [],
      'files' => ['required'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'categories.required' => 'Поле <strong>Категория</strong> обязательно для заполнения',
      'name.required' => 'Поле <strong>Название</strong> обязательно для заполнения',
      'manufacturer.required' => 'Поле <strong>Производитель</strong> обязательно для заполнения',
      'article.required' => 'Поле <strong>Артикул</strong> обязательно для заполнения',
      'article.unique' => 'Товар с таким <strong>Артикулом</strong> уже существует',
      'available.required' => 'Поле <strong>Наличие</strong> обязательно для заполнения',
      'price.required' => 'Поле <strong>Цена</strong> обязательно для заполнения',
      'material.required' => 'Поле <strong>Материал</strong> обязательно для заполнения',
      'technic.required' => 'Поле <strong>Техника</strong> обязательно для заполнения',
      'files.required' => 'Поле <strong>Фотография</strong> обязательно для заполнения',
      'meta_keywords.required' => 'Поле <strong>Мета keywords</strong> обязательно для заполнения',
      'meta_description.required' => 'Поле <strong>Мета description</strong> обязательно для заполнения',
      'meta_title.required' => 'Поле <strong>Мета title</strong> обязательно для заполнения',
    ];
  }

  /**
   * Handle a failed validation attempt.
   *
   * @param \Illuminate\Contracts\Validation\Validator $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json(['errors' => $validator->errors()]));
  }
}
