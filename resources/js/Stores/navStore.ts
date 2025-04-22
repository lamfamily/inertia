import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useNavStore = defineStore('navigation', () => {
  const activeItem = ref<string>('');

  const navItems = ref([
    { name: 'Dashboard', route: 'dashboard' },
    { name: '关于', route: 'about' },
  ]);

  function setActiveItem(item: string) {
    activeItem.value = item;
  }

  return {
    activeItem,
    navItems,
    setActiveItem,
  };
});
