<template>
  <div>
    <NavBar v-if="isAuthenticated" @logout="logout" />
    <router-view @logout="logout" @login="login" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../components/NavBar.vue';
import { useRouter } from 'vue-router';
import { isAuth } from '@/Mixins/authMixin.js';

const isAuthenticated = ref(false);
const router = useRouter();

const logout = () => {
  localStorage.clear();
  isAuthenticated.value = isAuth();
  router.push('/login');
};

const login = () => {
  setTimeout(() => {
    isAuthenticated.value = isAuth();
  }, 100);
};

onMounted(() => {
  isAuthenticated.value = isAuth();
  console.log( isAuthenticated.value);
});
</script> 

