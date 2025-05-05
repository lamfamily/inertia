import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from "path";
import tailwindcss from '@tailwindcss/vite'
import json5 from 'vite-plugin-json5'

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
    tailwindcss(),
    json5(),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
      'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
    },
  },
  server: {
    cors: true,
    // 默认是::1,ssh 远程访问不了，要改
    host: "localhost",
  }
});
