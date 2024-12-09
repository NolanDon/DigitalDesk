import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Home from './components/Home.vue';
import About from './components/About.vue';
import Pricing from './components/Pricing.vue';
import Contact from './components/Contact.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
  { path: '/pricing', component: Pricing },
  { path: '/contact', component: Contact },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
