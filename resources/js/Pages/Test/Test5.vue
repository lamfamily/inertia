<template>
  <Head title="test tailwindcss dropdown" />

  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="relative">
      <!-- 触发按钮 -->
      <div
        @click="open = !open"
        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none cursor-pointer select-none"
        aria-haspopup="true"
        aria-expanded="open"
      >
        更多操作
        <svg
          class="ml-2 w-4 h-4"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          stroke-width="2"
        >
          <path d="M6 9l6 6 6-6" />
        </svg>
      </div>

      <!-- 下拉菜单内容 -->
      <transition name="fade">
        <ul
          v-if="open"
          class="absolute w-44 bg-white rounded shadow-lg z-20 py-1"
          @click.stop
        >
          <li>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">个人中心</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">设置</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">退出登录</a>
          </li>
        </ul>
      </transition>
    </div>
  </div>
</template>

<script setup>
  import { Head } from '@inertiajs/vue3';
  // 控制下拉菜单开关
  import { ref, onMounted, onBeforeUnmount } from 'vue';
  const open = ref(false);

  // 点击外部时关闭菜单
  function handleClick(e) {
    // 如果点击的不是当前 dropdown 区域，就关闭
    if (!e.target.closest('.relative')) {
      open.value = false;
    }
  }
  onMounted(() => {
    document.addEventListener('click', handleClick);
  });
  onBeforeUnmount(() => {
    document.removeEventListener('click', handleClick);
  });
</script>

<style scoped>
  /* 淡入淡出动画 */
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.2s;
  }
</style>
