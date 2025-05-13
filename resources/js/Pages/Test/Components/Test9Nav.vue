<template>
  <div class="container mx-auto flex justify-between items-center px-4 py-3">
    <ul class="flex gap-6">
      <li><a href="javascript:void(0)" class="hover:text-blue-500">首頁</a></li>
      <li><a href="javascript:void(0)" class="hover:text-blue-500">產品</a></li>
      <li><a href="javascript:void(0)" class="hover:text-blue-500">關於</a></li>
      <li>
        <a href="javascript:void(0)" class="hover:text-blue-500">
          <MagnifyingGlassIcon class="size-5 inline-block" />
        </a>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'
</script>
