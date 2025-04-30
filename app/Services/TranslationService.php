<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use ColinODell\Json5\Json5Decoder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    /**
     * 缓存时间（分钟）
     */
    const CACHE_TIME = 60;

    /**
     * 获取指定语言的所有翻译
     */
    public function getTranslations(string $locale): array
    {
        $cacheKey = "translations_{$locale}";

        // 尝试从缓存中获取翻译
        return Cache::remember($cacheKey, self::CACHE_TIME, function() use ($locale) {
            $path = lang_path("{$locale}.json5");

            if (!File::exists($path)) {
                Log::warning("Translation file not found: {$locale}.json5");
                return [];
            }

            try {
                $content = File::get($path);
                return Json5Decoder::decode($content, true);
            } catch (\Exception $e) {
                Log::error("Failed to parse {$locale}.json5: " . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * 获取指定翻译键的值
     */
    public function get(string $key, array $replace = [], string $locale = ''): string
    {
        $locale = $locale ?: app()->getLocale();
        $translations = $this->getTranslations($locale);

        // 获取翻译值（支持嵌套键，如'user.profile.title'）
        $value = Arr::get($translations, $key, $key);

        // 处理不同情况
        if (is_null($value) || $value === '') {
            // 如果找不到翻译，尝试使用备用语言
            if ($locale !== config('app.fallback_locale')) {
                return $this->get($key, $replace, config('app.fallback_locale'));
            }
            // 最终回退到键名本身
            return $key;
        }

        // 如果是复数形式的处理
        if (is_array($value) && isset($value['one']) && isset($value['other'])) {
            $count = $replace['count'] ?? 1;
            $value = $count == 1 ? $value['one'] : $value['other'];
        }

        // 替换变量
        if (is_string($value)) {
            // 处理 :name 格式的变量
            foreach ($replace as $paramKey => $paramValue) {
                $value = str_replace(":{$paramKey}", $paramValue, $value);
            }

            // 处理 {name} 格式的变量
            $value = preg_replace_callback('/{([^}]+)}/', function($matches) use ($replace) {
                $paramKey = $matches[1];
                return $replace[$paramKey] ?? $matches[0];
            }, $value);
        }

        return $value;
    }

    /**
     * 清除翻译缓存
     */
    public function clearCache(string $locale = ''): void
    {
        if ($locale) {
            Cache::forget("translations_{$locale}");
        } else {
            // 清除所有语言的缓存
            $locales = config('app.allowed_locales'); // 可以从配置中获取支持的语言列表
            foreach ($locales as $loc) {
                Cache::forget("translations_{$loc}");
            }
        }
    }
}
