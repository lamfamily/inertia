import axios from 'axios';
import { useLanguageStore } from '@/stores/languageStore';
import { useAuthStore } from '@/stores/authStore';

// 创建一个获取存储的函数，使用闭包而不是 require
const getStores = () => {
  let languageStoreInstance: ReturnType<typeof useLanguageStore> | null = null;
  let authStoreInstance: ReturnType<typeof useAuthStore> | null = null;

  return () => {
    // 延迟初始化，只在需要时获取 store 实例
    if (!languageStoreInstance) {
      try {
        languageStoreInstance = useLanguageStore();
      } catch (e) {
        // store 可能尚未初始化
      }
    }

    if (!authStoreInstance) {
      try {
        authStoreInstance = useAuthStore();
      } catch (e) {
        // store 可能尚未初始化
      }
    }

    return {
      languageStore: languageStoreInstance,
      authStore: authStoreInstance
    };
  };
};

// 创建 getStoresInstance 函数
const getStoresInstance = getStores();

// 配置axios默认值
axios.defaults.withCredentials = true; // 允许发送和接收cookie

// 请求拦截器
axios.interceptors.request.use(config => {
  const stores = getStoresInstance();

  // 设置语言
  if (stores.languageStore) {
    config.headers['X-Locale'] = stores.languageStore.currentLocale;
  } else {
    // 回退到 localStorage
    config.headers['X-Locale'] = localStorage.getItem('locale') || 'en-US';
  }

  // 设置认证令牌（如果存在）
  const token = localStorage.getItem('token');
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }

  return config;
});

// 响应拦截器处理 401 错误
axios.interceptors.response.use(
  response => {
    // 检查响应头中是否有新令牌
    const newToken = response.headers['authorization'];
    if (newToken && newToken.startsWith('Bearer ')) {
      const token = newToken.slice(7);
      localStorage.setItem('token', token);

      // 更新 axios 默认头
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      // 如果 authStore 已初始化，更新其中的令牌
      const stores = getStoresInstance();
      if (stores.authStore) {
        stores.authStore.setToken(token);
      }
    }

    return response;
  },
  async error => {
    const originalRequest = error.config;

    // 如果是 401 错误并且不是刷新令牌请求
    if (error.response && error.response.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;

      try {
        // 尝试刷新令牌
        const stores = getStoresInstance();
        if (stores.authStore) {
          await stores.authStore.refreshToken();

          // 使用新令牌重新发起原请求
          const token = localStorage.getItem('token');
          if (token) {
            originalRequest.headers['Authorization'] = `Bearer ${token}`;
          }
          return axios(originalRequest);
        }
      } catch (refreshError) {
        // 如果刷新失败，重定向到登录页面
        window.location.href = '/login';
        return Promise.reject(refreshError);
      }
    }

    return Promise.reject(error);
  }
);

export default axios;
