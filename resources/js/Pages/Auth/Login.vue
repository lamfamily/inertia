<template>
  <Head title="Login" />
  <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        {{ $t('auth.login.title') }}
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="submitForm">
          <div v-if="error" class="rounded-md bg-red-50 p-4 mb-4">
            <div class="flex">
              <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ error }}</p>
              </div>
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              {{ $t('auth.login.email') }}
            </label>
            <div class="mt-1">
              <input
                id="email"
                v-model="form.email"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email }}</div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              {{ $t('auth.login.password') }}
            </label>
            <div class="mt-1">
              <input
                id="password"
                v-model="form.password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div v-if="errors.password" class="text-red-500 text-sm mt-1">
              {{ errors.password }}
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              :disabled="loading"
            >
              <span v-if="loading">{{ $t('auth.login.loading') }}</span>
              <span v-else>{{ $t('auth.login.submit') }}</span>
            </button>
          </div>
        </form>

        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">
                {{ $t('auth.login.noAccount') }}
              </span>
            </div>
          </div>

          <div class="mt-6">
            <a
              href="/register"
              class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              {{ $t('auth.login.register') }}
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="absolute top-4 right-4">
      <LanguageSwitcher />
    </div>
  </div>
</template>

<script setup lang="ts">
  import { Head } from '@inertiajs/vue3';
  import { ref, reactive } from 'vue';
  import { useI18n } from 'vue-i18n';
  import { useAuthStore } from '@/stores/authStore';
  import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
  import { router } from '@inertiajs/vue3';

  const { t } = useI18n();
  const authStore = useAuthStore();

  const form = reactive({
    email: '',
    password: '',
  });

  const loading = ref(false);
  const error = ref('');
  const errors = reactive({
    email: '',
    password: '',
  });

  const submitForm = async () => {
    loading.value = true;
    error.value = '';
    errors.email = '';
    errors.password = '';

    try {
      await authStore.login(form.email, form.password);
      router.visit('/'); // 成功后重定向到首页
    } catch (err: any) {
      if (err.response && err.response.data && err.response.data.errors) {
        const apiErrors = err.response.data.errors;
        if (apiErrors.email) errors.email = apiErrors.email[0];
        if (apiErrors.password) errors.password = apiErrors.password[0];
      } else {
        error.value = t('auth.login.failed');
      }
    } finally {
      loading.value = false;
    }
  };
</script>
