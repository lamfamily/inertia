import { createI18n } from 'vue-i18n';

// 导入语言文件
// @ts-ignore
import zhCN from './locales/zh-CN.json5';
// @ts-ignore
import enUS from './locales/en-US.json5';

// 解析JSON5格式
const messages = {
  'zh-CN': zhCN,
  'en-US': enUS,
};

// 从localStorage读取保存的语言设置，默认为英文
const locale = localStorage.getItem('locale') || 'en-US';

export default createI18n({
  legacy: false, // 使用Composition API
  locale,
  fallbackLocale: 'en-US',
  messages
});
