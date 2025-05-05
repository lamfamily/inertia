<template>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <Link :href="route('dashboard')" class="text-white font-bold text-xl">
          应用名称
          </Link>
        </div>

        <!-- 导航链接 -->
        <div class="flex space-x-4">
          <Link v-for="item in navStore.navItems" :key="item.route" :href="route(item.route)" :class="[
            navStore.activeItem === item.route
              ? 'bg-gray-900 text-white'
              : 'text-gray-300 hover:bg-gray-700 hover:text-white',
            'px-3 py-2 rounded-md text-sm font-medium'
          ]">
          {{ item.name }}
          </Link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { onMounted, watch, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useNavStore } from '@/stores/navStore';
import { route } from 'ziggy-js';

const navStore = useNavStore();
const page = usePage();

// 当前路由
const currentRoute = computed(() => page.component);

console.log(currentRoute.value);

</script>
