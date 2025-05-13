<template>
  <div class="container mx-auto flex justify-between items-center px-4 py-3">
    <div class="w-full flex items-center justify-between">
      <ul class="flex gap-6">
        <li>
          <a href="javascript:void(0)" class="hover:text-blue-500" @click="handleNavClick">首頁</a>
          <div class="subnav hidden absolute top-12 left-0 right-0 min-h-screen bg-blue-50">
            <ul class="flex gap-6">
              <li>二级导航1</li>
              <li>二级导航1</li>
              <li>二级导航1</li>
            </ul>
          </div>
        </li>
        <li>
          <a href="javascript:void(0)" class="hover:text-blue-500" @click="handleNavClick">產品</a>
          <div class="subnav hidden absolute top-12 left-0 right-0 min-h-screen bg-blue-50">
            <ul class="flex gap-6">
              <li>二级导航2</li>
              <li>二级导航2</li>
              <li>二级导航2</li>
            </ul>
          </div>
        </li>
        <li>
          <a href="javascript:void(0)" class="hover:text-blue-500" @click="handleNavClick">關於</a>
          <div class="subnav hidden absolute top-12 left-0 right-0 min-h-screen bg-blue-50">
            <ul class="flex gap-6">
              <li>二级导航3</li>
              <li>二级导航3</li>
              <li>二级导航3</li>
            </ul>
          </div>
        </li>
        <li>
          <a href="javascript:void(0)" class="hover:text-blue-500">
            <MagnifyingGlassIcon class="size-5 inline-block" />
          </a>
        </li>
      </ul>

      <div
        v-show="showLevel2"
        class="cursor-pointer hover: text-gray-500"
        @click="handleCloseClick"
      >
        &times;
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';
  import { ref } from 'vue';

  const showLevel2 = ref(false);

  const handleNavClick = (e: Event) => {
    showLevel2.value = true;

    const target = e.target as HTMLElement;
    const subnav = target.parentElement?.querySelector('.subnav');

    if (subnav) {
      subnav.classList.remove('hidden');
      document.body.style.overflow = 'hidden';

      // 隐藏其他的二级导航
      const subnav_list = document.querySelectorAll('.subnav');
      subnav_list.forEach(subnav => {
        if (subnav !== target.parentElement?.querySelector('.subnav')) {
          subnav.classList.add('hidden');
        }
      });

      // 隐藏消息栏
      document.querySelector('.message-bar')?.classList.add('hidden');
    }
  };

  const handleCloseClick = () => {
    showLevel2.value = false;
    document.body.style.overflow = 'auto';

    const subnav_list = document.querySelectorAll('.subnav');
    subnav_list.forEach(subnav => {
      subnav.classList.add('hidden');
    });

    document.querySelector('.message-bar')?.classList.remove('hidden');
  };
</script>
