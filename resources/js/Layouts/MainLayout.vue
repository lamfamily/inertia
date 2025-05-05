<template>
  <div class="min-h-screen bg-gray-50">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <div class="flex space-x-8">
              <a href="/" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                {{ $t('nav.home') }}
              </a>
              <a href="/about" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                {{ $t('nav.about') }}
              </a>
              <a href="/contact" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                {{ $t('nav.contact') }}
              </a>
            </div>
          </div>
          <div class="flex items-center">
            <LanguageSwitcher />
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot></slot>
    </main>
  </div>
</template>

<script setup lang="ts">
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
</script>
