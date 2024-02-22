<template>


	<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
		<div class="relative py-3 sm:max-w-xl sm:mx-auto">
			<div
				class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
			</div>
			<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
				<div class="max-w-md mx-auto">
					<div>
						<h1 class="text-2xl font-semibold">Login to AI</h1>
					</div>
					<div class="divide-y divide-gray-200">
						<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
							<form @submit.prevent="login" class="my-login-validation" novalidate="">
								<div class="relativeInput">
									<input required autofocus v-model="email" autocomplete="off" id="email" name="email" type="text"
										class=" input peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
										placeholder="Email address" />
									<label for="email"
										class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email
										Address</label>
								</div>
								<div class="relativeInput">
									<input   name="password" required
										data-eye v-model="password"   autocomplete="off" id="password"  type="password"
										class="input peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
										placeholder="Password" />
									<label for="password"
										class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
								</div>
								<div class="relativeInput">
									<button class="bg-blue-500 text-white rounded-md px-2 py-1">Submit</button>
								</div>
								<p v-if="errorMessage" style="color: red;"> {{ errorMessage }}</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import botImage from '@/img/login.gif';
import { postData } from '@/router/requestActions.js';
import Cookies from 'js-cookie';

export default {
	created() {
		this.$emit('logout');

	},
	data() {
		return {
			email: "",
			password: "",
			errorMessage: "",
			botImage: botImage,

		}
	},
	methods: {
		async login() {
			try {
				var response = await postData('auth/login', { email: this.email, password: this.password });
				this.storeToken(response.token)
				this.$emit('login');
				this.$router.push('/');
				localStorage.setItem("isAuth", true);
				localStorage.setItem("name", response.logedInUser.name);
				localStorage.setItem("phone", response.logedInUser.phone);
				localStorage.setItem("role", response.logedInUser.role);
				localStorage.setItem("email", response.logedInUser.email);
				localStorage.setItem("permissions", response.logedInUser.permissions);
				localStorage.setItem("logedInUser", response.logedInUser);
				localStorage.setItem("token", response.token);

			}
			catch (error) {
				console.log(error)
				this.errorMessage = error.response.data.message;
			}

		},
		storeToken(token) {
			Cookies.set('authUserToken', token, {
				secure: true, // Only send over HTTPS
			});
		}
	}
}
</script>

<style scoped>
.input{
	font-size: smaller;
    padding: 20px;
}
.relativeInput {
	position: relative;
    margin: 10px;}
</style>