<template>
    <h1> Login To AI Doctor Assessten</h1>
    <form @submit.prevent="login">
        <input type="email" v-model="email" name="email">
        <input type="password" v-model="password">
        <button type="submit">Login</button>
        <p  v-if="errorMessage" style="color: red;"> {{  errorMessage }}</p>
    </form>
</template>
<script>
import {  postData } from '@/router/requestActions.js';  
import Cookies from 'js-cookie';

export default {
    data() {
        return {
            email: "",
            password :"",
            errorMessage: ""

        }
    },
    methods:{ 
      async  login(){ 
            try{
                var response=  await postData('auth/login',{email:this.email,password: this.password});
                console.log(response);
                console.log(response.token);


              //  document.cookie = `token=${token}; Secure; HttpOnly; SameSite=None;`+" expires=" + new Date(Date.now() + 3600000).toUTCString() ;
              //  document.cookie = `authUserToken=${response.token}; HttpOnly`;
                this.storeToken(response.token)
               this.$router.push('/');
                localStorage.setItem("isAuth",true);
                localStorage.setItem("token",response.token);

            }
            catch (error) {
                this.errorMessage="Authentication failed";
            }

        },
         storeToken(token)  {
            Cookies.set('authUserToken', token, {
                secure: true, // Only send over HTTPS
            });
        }
    }
}
</script>