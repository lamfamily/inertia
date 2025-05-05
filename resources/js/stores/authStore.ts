import { defineStore } from 'pinia';
import axios from 'axios';

interface User {
  id: number;
  name: string;
  email: string;
}

interface AuthState {
  token: string | null;
  user: User | null;
  loading: boolean;
}

export const useAuthStore = defineStore('auth', {
  state: (): AuthState => ({
    token: localStorage.getItem('token'),
    user: null,
    loading: false
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    getUser: (state) => state.user,
  },

  actions: {
    // 新增方法，用于更新令牌
    setToken(token: string) {
      this.token = token;
      localStorage.setItem('token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },

    async login(email: string, password: string) {
      this.loading = true;
      try {
        const response = await axios.post('/api/auth/login', { email, password });
        this.token = response.data.authorization.token;
        this.user = response.data.user;
        localStorage.setItem('token', this.token ?? '');

        // 设置 axios 默认头
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

        return response;
      } catch (error) {
        this.token = null;
        this.user = null;
        localStorage.removeItem('token');
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async logout() {
      this.loading = true;
      try {
        // 尝试调用后端注销 API
        await axios.post('/api/auth/logout');
      } catch (error) {
        console.error('Logout API error:', error);
        // 即使 API 调用失败，我们仍然清除本地状态
      } finally {
        // 无论 API 调用是否成功，都清除本地认证状态
        this.token = null;
        this.user = null;
        localStorage.removeItem('token');

        // 清除 axios 默认头
        delete axios.defaults.headers.common['Authorization'];

        this.loading = false;
      }
    },

    async fetchUser() {
      if (!this.token) return;

      this.loading = true;
      try {
        const response = await axios.get('/api/auth/me');
        this.user = response.data;
      } catch (error) {
        // 不要自动清除令牌，因为它可能存在于 cookie 中
        console.error('Failed to fetch user:', error);
      } finally {
        this.loading = false;
      }
    },

    async refreshToken() {
      if (!this.token) return;

      this.loading = true;
      try {
        const response = await axios.post('/api/auth/refresh');
        this.token = response.data.authorization.token;
        localStorage.setItem('token', this.token ?? '');

        // 更新 axios 默认头
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

      } catch (error) {
        this.token = null;
        this.user = null;
        localStorage.removeItem('token');
      } finally {
        this.loading = false;
      }
    },

    initAuth() {
      // 设置 axios 默认携带凭证
      axios.defaults.withCredentials = true;

      if (this.token) {
        // 如果有本地存储的令牌，设置在 axios 头中
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      }

      // 无论是否有本地令牌，都尝试获取用户信息
      // 这将依赖于 HTTP-only cookie 中的令牌
      this.fetchUser();
    }
  }
});
