<?php

declare(strict_types=1);


namespace App\Http\Filters\Var1;

use Illuminate\Database\Eloquent\Builder;

class WorkerFilter
{
    public array $params = [];

    /**
     * Поля фильтрации
    */
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const EMAIL = 'email';
    public const AGE_FROM = 'age_from';
    public const AGE_TO = 'age_to';
    public const DESCRIPTION = 'description';
    public const IS_MARRIED = 'is_married';

    /**
     * @param array $params массив со значениями фильтрации
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Вызываем те методы фильтрации, значения которых существует
     */
    public function getFilters(Builder $builder): void
    {
        foreach (self::getCallbacks() as $attribute => $method) {
            if (isset($this->params[$attribute])) {
                self::$method($builder, $this->params[$attribute]);
            }
        }
    }

    /**
     * Возвращает необходимые методы для фильтрации
     *
     * @return array
     */
    public static function getCallbacks(): array
    {
        return [
            self::NAME        => 'getName',
            self::SURNAME     => 'getSurname',
            self::EMAIL       => 'getEmail',
            self::AGE_FROM    => 'getAgeFrom',
            self::AGE_TO      => 'getAgeTo',
            self::DESCRIPTION => 'getDescription',
            self::IS_MARRIED  => 'getIsMarried',
        ];
    }

    /**
     * Фильтрация по имени
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getName(Builder $builder, string $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация по фамилии
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getSurname(Builder $builder, string $value): void
    {
        $builder->where('surname', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация по почте
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getEmail(Builder $builder, string $value): void
    {
        $builder->where('email', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация по возрасту от
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getAgeFrom(Builder $builder, string $value): void
    {
        $builder->where('age', '>=', (int)$value);
    }

    /**
     * Фильтрация по возрасту до
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getAgeTo(Builder $builder, string $value): void
    {
        $builder->where('age', '<=', (int)$value);
    }

    /**
     * Фильтрация по описанию
     *
     * @param Builder $builder
     * @param string $value
     *
     * @return void
     */
    public static function getDescription(Builder $builder, string $value): void
    {
        $builder->where('description', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация женат/не женат
     *
     * @param Builder $builder
     *
     * @return void
     */
    public static function getIsMarried(Builder $builder): void
    {
        $builder->where('is_married', true);
    }


}
