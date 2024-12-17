import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import tailwindcss from 'tailwindcss';

export default defineConfig({
  plugins: [vue()],
  build: {
    rollupOptions: {
      input: '/resources/js/app.js',  // Tentukan file entry point kamu di sini
    },
  },
  css: {
    postcss: {
      plugins: [tailwindcss],
    },
  },
});
