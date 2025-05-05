import { defineStore } from 'pinia';

export const useLanguageStore = defineStore('language', {
  state: () => ({
    currentLocale: localStorage.getItem('locale') || 'en-US',
  }),

  actions: {
    setLocale(locale: string) {
      this.currentLocale = locale;
      localStorage.setItem('locale', locale);
    }
  }
});
