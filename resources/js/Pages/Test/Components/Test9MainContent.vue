<template>
  <main class="container mx-auto px-4 py-6 space-y-8">
    <section v-for="i in 100" :key="i" class="bg-gray-100 rounded p-8 mb-8 shadow">
      <h2 class="text-2xl font-bold mb-2">內容區塊 {{ i }}</h2>
      <p>下滑/上滑頁面觀察雙導航欄的體驗：只有一個導航欄會顯示，互不重疊。</p>
    </section>
  </main>
</template>
