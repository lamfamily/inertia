<template>
  <div class="relative">
    <button @click="toggleDropdown"
      class="flex items-center px-3 py-2 text-sm font-medium rounded-md bg-gray-100 hover:bg-gray-200">
      {{ currentLanguageName }}
      <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
          clip-rule="evenodd" />
      </svg>
    </button>

    <div v-if="isOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
      <div class="py-1">
        <a v-for="locale in availableLocales" :key="locale" href="#" @click.prevent="changeLocale(locale)"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          {{ $t(`language.${locale}`) }}
        </a>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/languageStore';

const { t, locale } = useI18n();
const languageStore = useLanguageStore();
const isOpen = ref(false);

const availableLocales = ['en-US', 'zh-CN'];

const currentLanguageName = computed(() => {
  return t(`language.${locale.value}`);
});

function toggleDropdown() {
  isOpen.value = !isOpen.value;
}

function changeLocale(newLocale: string) {
  locale.value = newLocale;
  languageStore.setLocale(newLocale);
  isOpen.value = false;
}
</script>
