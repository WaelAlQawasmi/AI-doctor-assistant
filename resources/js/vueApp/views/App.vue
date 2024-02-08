<template>
    <NavBar :isAuth="isAuthUser" @logout="logout" />
    <router-view @logout="logout" @login="login" /> 
</template>
<script setup>
import NavBar from '../components/NavBar.vue';
 import { RouterView } from 'vue-router';

</script>

<script>
import { getLoginUser, isAuth } from '@/Mixins/authMixin.js';

export default {
  created(){
this.isAuthUser=isAuth()
  },
  data(){
    return{
      isAuthUser:'',
    }
  },
  methods:{
    isAuth,
    logout(){
      localStorage.clear();
      this.$router.push('/login');
      this.isAuthUser=isAuth();
    },
    login(){
      console.log("login")
      this.isAuthUser=isAuth();

      console.log(this.isAuthUser)

    }
  }

}
</script>