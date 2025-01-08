<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoForbiddenWords implements ValidationRule
{

    protected array $forbiddenWords = ['禁止ワード', '禁止単語'];
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                $fail("投稿内容に禁止ワードが含まれています。");
            }
        }
        
    }
}
