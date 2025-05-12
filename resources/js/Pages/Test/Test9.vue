<template>
  <Head title="吸顶" />

  <!-- 消息栏 -->
  <div class="w-full bg-black text-white text-center py-2">這是公告消息，所有訂單免運費！</div>

  <!-- 流式导航栏（始终在文档流） -->
  <nav ref="navRef" class="w-full bg-white shadow">
    <Test9Nav />
  </nav>

  <!-- fixed 吸顶导航栏（只在上滑且未重叠时显示） -->
  <transition name="slide-down">
    <nav
      v-if="showFixedNav"
      class="fixed top-0 left-0 w-full bg-white shadow z-40 transition-transform duration-300"
      :style="{ transform: showFixedNav ? 'translateY(0)' : 'translateY(-100%)' }"
    >
      <Test9Nav />
    </nav>
  </transition>

  <!-- 占位，防止fixed导航栏遮住内容 -->
  <div :style="{ height: fixedNavHeight + 'px' }"></div>

  <!-- 主内容 -->
  <main class="container mx-auto px-4 py-6 space-y-8">
    <section v-for="i in 100" :key="i" class="bg-gray-100 rounded p-8 mb-8 shadow">
      <h2 class="text-2xl font-bold mb-2">內容區塊 {{ i }}</h2>
      <p>下滑/上滑頁面觀察雙導航欄的體驗：只有一個導航欄會顯示，互不重疊。</p>
    </section>
  </main>
</template>

<script setup lang="ts">
  import { ref, onMounted, onUnmounted, nextTick } from 'vue';
  import { Head } from '@inertiajs/vue3';
  import Test9Nav from '@/Pages/Test/Components/Test9Nav.vue';

  const navRef = ref<HTMLElement | null>(null);
  const fixedNavHeight = ref(0);

  let navOffsetTop = 0; // 流式nav距离页面顶部的位置
  let lastY = window.scrollY;

  const showFixedNav = ref(false);

  function updateOffsets() {
    // DOM 更新完成后再执行括号里的函数
    nextTick(() => {
      navOffsetTop = (navRef.value?.getBoundingClientRect().top ?? 0) + window.scrollY;
      fixedNavHeight.value = navRef.value?.offsetHeight ?? 0;
    });
  }

  function onScroll() {
    const y = window.scrollY;
    const isUp = y < lastY;

    // 只有当：
    // 1. 上滑（isUp）
    // 2. 且流式导航栏已经被滚出视口（y > navOffsetTop）
    // 才显示fixed导航栏
    if (isUp && y > navOffsetTop) {
      showFixedNav.value = true;
    } else {
      showFixedNav.value = false;
    }

    lastY = y;
  }

  onMounted(() => {
    updateOffsets();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', updateOffsets);
  });
  onUnmounted(() => {
    window.removeEventListener('scroll', onScroll);
    window.removeEventListener('resize', updateOffsets);
  });
</script>

<style scoped>
  .slide-down-enter-active,
  .slide-down-leave-active {
    transition:
      transform 0.25s,
      opacity 0.25s;
  }
  .slide-down-enter-from,
  .slide-down-leave-to {
    transform: translateY(-100%);
    opacity: 0;
  }
  .slide-down-enter-to,
  .slide-down-leave-from {
    transform: translateY(0);
    opacity: 1;
  }
</style>
