<template>

<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img :src="botImage"  class="ml-5" height="200" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form @submit.prevent="login" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" required autofocus  v-model="email" name="email">
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye v-model="password">
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-info btn-block">
										Login
									</button>
								</div>
                                <p  v-if="errorMessage" style="color: red;"> {{  errorMessage }}</p>
								<div class="mt-4 text-center">
									Don't have an account? <a href="register.html">Create One</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
import botImage from '@/img/login.gif';

import {  postData } from '@/router/requestActions.js';  
import Cookies from 'js-cookie';

export default {
    data() {
        return {
            email: "",
            password :"",
            errorMessage: "",
            botImage: botImage,

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