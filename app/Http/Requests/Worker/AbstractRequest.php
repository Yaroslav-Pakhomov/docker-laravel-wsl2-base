<?php

declare(strict_types=1);

namespace App\Http\Requests\Worker;

//use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    /**
     * С какой сущностью сейчас работаем (товар каталога)
     *
     * @var array
     */
    protected array $entity = [
        'name'  => 'worker',
        'table' => 'workers',
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array|bool
     */
    public function rules(): array|bool
    {
        return match ($this->method()) {
            'GET' => $this->indexItem(),
            'POST' => $this->createItem(),
            'PUT', 'PATCH' => $this->updateItem(),
            default => false,
        };
    }

    /**
     * @return array
     */
    protected function indexItem(): array
    {
        return [
            'name'        => [
                'nullable',
                'max:100',
                'string',
            ],
            'surname'     => [
                'nullable',
                'min:1',
                'string',
            ],
            'email'       => [
                'nullable',
                'between:3,100',
                'string',
                'unique:' . $this->entity['table'] . ',email',
            ],
            'age_from'    => [
                'nullable',
                'integer',
            ],
            'age_to'      => [
                'nullable',
                'integer',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_married'  => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function createItem(): array
    {
        return [
            'name'        => [
                'required',
                'max:100',
                'string',
            ],
            'surname'     => [
                'required',
                'min:3',
                'string',
            ],
            'email'       => [
                'required',
                'between:3,100',
                'email',
                'unique:' . $this->entity['table'] . ',email',
            ],
            'age'         => [
                'nullable',
                'integer',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_married'  => [
                'nullable',
                'string',
            ],
        ];
    }


    /**
     * @return array
     */
    protected function updateItem(): array
    {
        $model = $this->route($this->entity['name']);
        return [
            'name'        => [
                'required',
                'max:100',
                'string',
            ],
            'surname'     => [
                'required',
                'min:3',
                'string',
            ],
            'email'       => [
                'required',
                'between:3,100',
                'email',
                Rule::unique($this->entity['table'], 'email')->ignore($model->id),
            ],
            'age'         => [
                'nullable',
                'integer',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_married'  => [
                'nullable',
                'string',
            ],
        ];
    }


    /**
     * Получите сообщения об ошибках для определенных правил проверки.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute является обязательным для заполнения.',
            'between'  => 'Значение :input поля :attribute не находится в диапазоне :min - :max.',
            'max'      => 'Поле :attribute не должно превышать :max.',
            'min'      => 'Поле :attribute не должно быть меньше :min.',
            'string'   => 'Поле :attribute должно быть строкой.',
            'integer'  => 'Поле :attribute должно быть числом.',
            'email'    => [
                'email' => 'Поле :attribute должно быть формата электронной почты.',
            ],

        ];
    }

    /**
     * Получите пользовательские атрибуты для ошибок проверки.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'        => 'Имя',
            'surname'     => 'Фамилия',
            'email'       => 'Email адрес',
            'age'         => 'Возраст',
            'age_from'    => 'Возраст от',
            'age_to'      => 'Возраст до',
            'description' => 'Описание',
            'is_married'  => 'Семейное положение',
        ];
    }
}
