import { createApp } from 'vue';
import App from './App.vue';
import router from './router';  // Import router here

// Create the Vue app and use the router
createApp(App)
  .use(router)  // Use the router in the app
  .mount('#app');  // Mount the app to the DOM
