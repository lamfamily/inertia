<template>
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside
      :class="[
        'bg-gray-800 text-white flex flex-col transition-all duration-300 ease-in-out',
        collapsed ? 'w-16' : 'w-64'
      ]"
    >
      <!-- Header -->
      <div class="flex items-center justify-between h-16 px-4 border-b border-gray-700 flex-shrink-0">
        <span v-if="!collapsed" class="font-bold text-lg">Logo</span>
        <button
          @click="toggleSidebar"
          class="p-2 rounded hover:bg-gray-700 transition-colors"
          aria-label="Toggle Sidebar"
        >
          <ChevronLeftIcon v-if="collapsed" class="size-5" />
          <ChevronRightIcon v-else class="size-5" />
        </button>
      </div>
      <!-- Menu：flex-1 + overflow-y-auto + sidebar-scroll -->
      <nav class="flex-1 overflow-y-auto mt-4 sidebar-scroll">
        <ul>
          <li
            v-for="item in menuItems"
            :key="item.text"
            class="flex items-center px-4 py-3 hover:bg-gray-700 cursor-pointer transition-colors"
          >
            <span class="mr-3 flex-shrink-0">
              <HomeIcon class="size-5" v-if="item.icon === 'home'" />

              <CogIcon class="size-5" v-else-if="item.icon === 'cog'" />

              <UserIcon class="size-5" v-else-if="item.icon === 'user'" />

              <FireIcon class="size-5" v-else />
            </span>
            <span v-if="!collapsed">{{ item.text }}</span>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- overflow-y-auto 是关键，否则左侧栏，跟着main content下滑 -->
    <Test1MainContent class="flex-1 overflow-y-auto main-scroll" />
  </div>
</template>

<script setup lang="ts">
import { HomeIcon, CogIcon, UserIcon, FireIcon, ChevronRightIcon, ChevronLeftIcon } from '@heroicons/vue/24/solid'
import { ref } from 'vue'
import Test1MainContent from './Components/Test1MainContent.vue'

const collapsed = ref(false)
const toggleSidebar = () => (collapsed.value = !collapsed.value)

const menuItems = [
  { text: '首页', icon: 'home' },
  { text: '设置', icon: 'cog' },
  { text: '用户', icon: 'user' },
  ...Array.from({ length: 30 }, (_, i) => ({
    text: `菜单${i + 1}`,
    icon: 'other'
  }))
]
</script>

<style scoped>
/* 滚动条美化：适用于 Chrome, Edge, Safari */
.sidebar-scroll::-webkit-scrollbar {
  width: 8px;
}
.sidebar-scroll::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #334155 30%, #64748b 100%);
  border-radius: 4px;
}
.sidebar-scroll::-webkit-scrollbar-track {
  background: transparent;
}

/* Firefox */
.sidebar-scroll {
  scrollbar-color: #64748b #334155;
  scrollbar-width: thin;
}

/* 鼠标悬停滚动条时更亮一点 */
.sidebar-scroll::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* 右侧滚动条美化 */
.main-scroll::-webkit-scrollbar {
  width: 10px;
}
.main-scroll::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #a3a3a3 30%, #64748b 100%);
  border-radius: 4px;
}
.main-scroll::-webkit-scrollbar-track {
  background: transparent;
}

.main-scroll {
  scrollbar-color: #64748b #a3a3a3;
  scrollbar-width: thin;
}

.main-scroll::-webkit-scrollbar-thumb:hover {
  background: #60a5fa;
}
</style>
