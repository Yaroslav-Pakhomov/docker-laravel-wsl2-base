<?php

declare(strict_types=1);

namespace App\Http\Requests\Worker;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends AbstractRequest
{

    /**
     * Объединяет дефолтные правила и правила, специфичные для создания
     * для проверки данных при добавлении нового работника
     */
    protected function createItem(): array
    {
        $rules = [];

        return array_merge(parent::createItem(), $rules);
    }


    /**
     * Объединяет дефолтные правила и правила, специфичные для обновления
     * для проверки данных при обновлении существующего работника
     */
    protected function updateItem(): array
    {
        $rules = [];

        return array_merge(parent::updateItem(), $rules);
    }

}
