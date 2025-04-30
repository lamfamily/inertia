<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    /**
     * 获取指定语言的翻译
     */
    public function getTranslations($locale)
    {
        // 验证语言代码是否有效
        $locale = in_array($locale, config('app.allowed_locales')) ? $locale : config('app.locale');

        // 获取翻译数据
        $translations = $this->translationService->getTranslations($locale);

        if (empty($translations)) {
            return response()->json([
                'error' => 'Translation file not found or empty'
            ], 404);
        }

        return response()->json($translations);
    }
}
