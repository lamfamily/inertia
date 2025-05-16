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
          <svg v-if="collapsed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
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
              <svg v-if="item.icon === 'home'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6h6M9 21H6a2 2 0 01-2-2V9a2 2 0 012-2h3m3 0h3a2 2 0 012 2v10a2 2 0 01-2 2h-3" />
              </svg>
              <svg v-else-if="item.icon === 'cog'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11.25 4.318c.443-1.183 1.924-1.183 2.367 0a1.724 1.724 0 002.573.97c1.02-.593 2.218.604 1.626 1.623a1.724 1.724 0 00.97 2.573c1.183.443 1.183 1.924 0 2.367a1.724 1.724 0 00-.97 2.573c.593 1.02-.604 2.218-1.623 1.626a1.724 1.724 0 00-2.573.97c-.443 1.183-1.924 1.183-2.367 0a1.724 1.724 0 00-2.573-.97c-1.02.593-2.218-.604-1.626-1.623a1.724 1.724 0 00-.97-2.573c-1.183-.443-1.183-1.924 0-2.367a1.724 1.724 0 00.97-2.573c-.593-1.02.604-2.218 1.623-1.626.874.51 2.02.51 2.573-.97z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <svg v-else-if="item.icon === 'user'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A6 6 0 0012 21a6 6 0 006.879-3.196M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </span>
            <span v-if="!collapsed">{{ item.text }}</span>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content：独立滚动条 -->
    <main class="flex-1 bg-gray-100 p-6 overflow-y-auto main-scroll">
      <h1 class="text-2xl font-bold mb-4">主内容区</h1>
      <p v-for="n in 100" :key="n">这里是你的主内容区域（第{{ n }}行）</p>
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const collapsed = ref(false)
const toggleSidebar = () => (collapsed.value = !collapsed.value)

const menuItems = [
  { text: '首页', icon: 'home' },
  { text: '设置', icon: 'cog' },
  { text: '用户', icon: 'user' },
  ...Array.from({ length: 30 }, (_, i) => ({
    text: `菜单${i + 1}`,
    icon: 'user'
  }))
]
</script>

<style scoped>
/* 左侧滚动条美化 */
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

.sidebar-scroll {
  scrollbar-color: #64748b #334155;
  scrollbar-width: thin;
}

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
