<?php

use App\Services\TranslationService;

if (!function_exists('t')) {
    /**
     * 获取翻译值
     *
     * @param string $key 翻译键
     * @param array $replace 替换参数
     * @param string|null $locale 语言代码
     * @return string
     */
    function t(string $key, array $replace = [], string $locale = ''): string
    {
        return app(TranslationService::class)->get($key, $replace, $locale);
    }
}
