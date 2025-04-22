# 创建 Laravel 10 + Inertia.js + Vue 3 + TypeScript 项目

以下是创建一个完整的 Laravel 10 + Inertia.js + Vue 3 + TypeScript 项目的详细步骤：

## 1. 创建新的 Laravel 项目

首先，确保你有最新版本的 Composer 和 Node.js 安装。然后使用以下命令创建一个新的 Laravel 10 项目：

```bash
composer create-project laravel/laravel="10.*.*" --prefer-dist inertia
cd inertia-vue-ts-app
```

## 2. 安装 Inertia.js 服务端依赖

```bash
composer require inertiajs/inertia-laravel
```

## 3. 发布 Inertia 中间件

```bash
php artisan inertia:middleware
```

然后在 `app/Http/Kernel.php` 的 `web` 中间件组中注册这个中间件：

```php
'web' => [
    // ...
    \App\Http\Middleware\HandleInertiaRequests::class,
],
```

## 4. 配置前端

安装 Vue 3 和 Inertia.js 的客户端依赖：

```bash
npm install @inertiajs/vue3
```

## 5. 安装并配置 TypeScript

```bash
npm install -D typescript vue-tsc @types/node
```

创建 `tsconfig.json` 文件：

```bash
touch tsconfig.json
```

编辑 `tsconfig.json` 内容：

```json
{
  "compilerOptions": {
    "target": "esnext",
    "module": "esnext",
    "moduleResolution": "node",
    "strict": true,
    "jsx": "preserve",
    "sourceMap": true,
    "resolveJsonModule": true,
    "esModuleInterop": true,
    "lib": ["esnext", "dom"],
    "types": ["vite/client"],
    "baseUrl": ".",
    "paths": {
      "@/*": ["resources/js/*"]
    }
  },
  "include": [
    "resources/js/**/*.ts",
    "resources/js/**/*.d.ts",
    "resources/js/**/*.tsx",
    "resources/js/**/*.vue"
  ]
}
```

## 6. 安装 Vite 和 Vue 插件

Laravel 10 默认使用 Vite，需要安装 Vue 相关的插件：

```bash
npm install -D @vitejs/plugin-vue
```

配置 `vite.config.js` 文件：

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // Vite 处理资源 URL 的配置
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    server: {
        // 默认是::1,ssh 远程访问不了，要改
        host: "localhost",
    }
});
```

## 7. 创建 TypeScript 定义文件

创建 `resources/js/types/index.d.ts` 文件：

```typescript
/// <reference types="vite/client" />

declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  const component: DefineComponent<{}, {}, any>
  export default component
}

// Inertia 接口定义
declare module '@inertiajs/vue3' {
  import { Component } from 'vue'
  
  export interface PageProps {
    [key: string]: any
  }
  
  export interface Page {
    component: string
    props: PageProps
    url: string
    version: string | null
  }
}
```

## 8. 设置入口文件

修改 `resources/js/app.js` 为 `resources/js/app.ts`：

```typescript
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import '../css/app.css';

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});
```

## 9. 创建布局组件

创建 `resources/js/Layouts/MainLayout.vue`：

```vue
<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
  title?: string;
}>();
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <div class="flex-shrink-0 flex items-center">
              <Link href="/" class="text-xl font-bold">My App</Link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <Link href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition">
                Home
              </Link>
              <Link href="/about" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition">
                About
              </Link>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <main>
      <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <slot />
        </div>
      </div>
    </main>
  </div>
</template>
```

## 10. 创建页面组件

创建 `resources/js/Pages/Home.vue`：

```vue
<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: MainLayout,
});

interface Props {
  title: string;
}

const props = defineProps<Props>();
</script>

<template>
  <Head title="Home" />
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
      <h1 class="text-2xl font-bold">{{ props.title }}</h1>
      <p class="mt-4">Welcome to your Inertia.js application with Vue 3 and TypeScript!</p>
    </div>
  </div>
</template>
```

创建 `resources/js/Pages/About.vue`：

```vue
<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: MainLayout,
});
</script>

<template>
  <Head title="About" />
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
      <h1 class="text-2xl font-bold">About Page</h1>
      <p class="mt-4">This is an about page built with Inertia.js, Vue 3 and TypeScript.</p>
    </div>
  </div>
</template>
```

## 11. 修改Laravel控制器和路由

创建一个新的控制器：

```bash
php artisan make:controller PageController
```

编辑 `app/Http/Controllers/PageController.php`：

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home', [
            'title' => 'Home Page'
        ]);
    }

    public function about()
    {
        return Inertia::render('About');
    }
}
```

修改 `routes/web.php`：

```php
<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
```

## 12. 修改欢迎页面布局

编辑 `resources/views/app.blade.php`（如果不存在则创建）：

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel + Inertia + Vue 3 + TypeScript</title>
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
```

## 13. 安装 Tailwind CSS (可选)

```bash
npm install -D tailwindcss @tailwindcss/vite postcss autoprefixer
```

配置 `vite.config.js`：

```javascript
plugins: [
    tailwindcss(),
],
```

更新 `resources/css/app.css`：

```css
@import "tailwindcss";
```

## 14. 安装开发工具

```bash
npm install -D @vue/compiler-sfc
```

## 15. 启动应用

```bash
# 编译前端资源
npm run dev

# 启动 Laravel 应用
php artisan serve
```

## 16. 可选：安装其他实用依赖

```bash
# 表单处理工具
npm install @vueuse/core

# 状态管理
npm install pinia

# UI 框架 (例如 Headless UI)
npm install @headlessui/vue @heroicons/vue
```

## 17. 设置类型安全的模型和API接口（推荐）

创建 `resources/js/types/models.d.ts`：

```typescript
export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string | null;
  created_at: string;
  updated_at: string;
}

export interface Paginated<T> {
  data: T[];
  links: {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
  };
  meta: {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
  };
}
```

现在你有了一个完整的 Laravel 10 + Inertia.js + Vue 3 + TypeScript 项目，可以根据你的需求进一步开发和扩展。这个设置包含了基本的页面路由、布局和组件结构，并已配置好 TypeScript 支持。
