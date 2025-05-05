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
          <div class="flex items-center space-x-4">
            <LanguageSwitcher />

            <div v-if="user" class="flex items-center">
              <span class="text-gray-700 mr-2">{{ user.name }}</span>
              <button
                @click="logout"
                class="px-3 py-2 text-sm font-medium rounded-md bg-red-100 hover:bg-red-200 text-red-800"
              >
                {{ $t('nav.logout') }}
              </button>
            </div>
            <div v-else>
              <a
                href="/login"
                class="px-3 py-2 text-sm font-medium rounded-md bg-indigo-100 hover:bg-indigo-200 text-indigo-800"
              >
                {{ $t('nav.login') }}
              </a>
            </div>
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
import { computed, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import { useAuthStore } from '@/stores/authStore';
import { router } from '@inertiajs/vue3';

const { t } = useI18n();
const authStore = useAuthStore();
const user = computed(() => authStore.getUser);

async function logout() {
  // 添加确认对话框
  if (confirm(t('auth.logout.confirm'))) {
    try {
      await authStore.logout();

      // 可选：显示成功消息
      alert(t('auth.logout.success'));

      router.visit('/login');
    } catch (error) {
      console.error('Logout error:', error);
      // 如果请求失败，仍然清除本地存储并重定向
      localStorage.removeItem('token');
      router.visit('/login');
    }
  }
}

onMounted(() => {
  // 初始化认证
  authStore.initAuth();
});
</script>
