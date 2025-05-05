import axios from 'axios';

// 创建一个获取语言商店的函数，而不是立即导入
// 这样可以避免循环依赖问题
const getLanguageStore = () => {
  const { useLanguageStore } = require('@/stores/languageStore');
  return useLanguageStore();
};

axios.interceptors.request.use(config => {
  // 发送请求时获取当前语言设置
  try {
    const languageStore = getLanguageStore();
    config.headers['X-Locale'] = languageStore.currentLocale;
  } catch (e) {
    // 如果存储尚未初始化，使用默认语言或从 localStorage 获取
    config.headers['X-Locale'] = localStorage.getItem('locale') || 'en-US';
  }
  return config;
});

export default axios;
