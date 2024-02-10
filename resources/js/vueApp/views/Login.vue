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
	created(){
		this.$emit('logout');

	},
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
                this.storeToken(response.token)
				this.$emit('login');
                this.$router.push('/');
                localStorage.setItem("isAuth",true);
                localStorage.setItem("name",response.logedInUser.name);
                localStorage.setItem("phone",response.logedInUser.phone);
                localStorage.setItem("role",response.logedInUser.role);
                localStorage.setItem("email",response.logedInUser.email);
                localStorage.setItem("permissions",response.logedInUser.permissions);
                localStorage.setItem("logedInUser",response.logedInUser);
                localStorage.setItem("token",response.token);

            }
            catch (error) {
				console.log(error)
                this.errorMessage=error.response.data.message;
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
<style scoped>
@import '@/css/login.css'; 

</style>