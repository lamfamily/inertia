<template>
  <Head title="test tailwindcss modal" />
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <!-- 打开 Modal 按钮 -->
    <button
      @click="openModal"
      class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none"
    >
      打开 Modal
    </button>

    <!-- Modal 遮罩和内容，使用 v-if 动态显示 -->
    <transition name="fade">
      <!-- 遮罩层：fixed 固定定位，覆盖全屏，黑色半透明背景 -->
      <!-- @click.self 只在点击遮罩本身时才触发关闭（即点击内容区不会关闭） -->
      <div
        v-if="showModal"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
        @click.self="closeModal"
      >
        <!-- Modal 内容区域 -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative">
          <h2 class="text-xl font-semibold mb-4">这是一个 Modal</h2>
          <p class="mb-4 text-gray-700">
            你可以在这里放任何内容。
          </p>
          <!-- 右上角关闭按钮 -->
          <button
            @click="closeModal"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-700"
            aria-label="关闭"
          >
            &times;
          </button>
          <!-- 底部关闭按钮 -->
          <button
            @click="closeModal"
            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
          >
            关闭
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
// 引入 Vue 的响应式和生命周期 API
import { ref, onMounted, onBeforeUnmount } from 'vue'

import { Head } from '@inertiajs/vue3'

// 控制 Modal 显示/隐藏的变量，默认隐藏
const showModal = ref(false)

// 打开 Modal 的函数
function openModal() {
  showModal.value = true
  // 打开 Modal 时禁止页面滚动
  document.body.style.overflow = 'hidden'
}

// 关闭 Modal 的函数
function closeModal() {
  showModal.value = false
  // 恢复页面滚动
  document.body.style.overflow = ''
}

// 支持按下 ESC 键关闭 Modal
function onEscape(e) {
  if (e.key === 'Escape') {
    closeModal()
  }
}

// 组件挂载时监听 ESC 键，卸载时移除监听
// 这样可以,避免影响其他组件或页面
onMounted(() => {
  window.addEventListener('keydown', onEscape)
})
onBeforeUnmount(() => {
  window.removeEventListener('keydown', onEscape)
})
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
