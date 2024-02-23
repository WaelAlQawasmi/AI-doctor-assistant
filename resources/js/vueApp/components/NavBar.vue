<template>
   
    <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <!-- Logo -->
                    <a href="https://AI Doctor Assistant.com" class="flex items-center">
                    <img src="../img/robotDoctor-logo.png" class="mr-3 h-6 sm:h-9" alt="AI Doctor Assistant Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">AI Doctor</span>
                </a>
                </div>
                <div class="flex items-center lg:order-2">
                    <a v-if="!isLogin" href="/login"
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Login</a>
                    <a v-if="isLogin"
                        class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                        @click="logout">خروج</a>
                </div>
                <div class="flex">
                    <!-- Primary nav menu on desktop -->
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            
                                <a  v-if="!isLogin" href="/#Benefits"
                                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Benefits</a>

                                <a  v-if="!isLogin" href="/#HowItWorks"
                                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">How
                                    it works</a>
                                <a  v-if="!isLogin" href="/#Features"
                                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Features</a>


                                <a  v-if="!isLogin" href="/#home"
                                    class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                                    aria-current="page">Home</a>
                         

                          

                                <router-link   v-if="isLogin" to="/dashboard"
                                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                                    aria-current="page">الرئيسية</router-link>
                                <router-link   to="/users" v-if="isLogin && getRole() == 'admin' || getRole() == 'TechnicalAssistant'"
                                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">المستخدمين</router-link>

                        </div>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="sm:hidden ml-6 flex">
                        <button @click="toggleMobileMenu"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu dropdown -->
        <div :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }" class="sm:hidden px-2 pt-2 pb-3 space-y-1">
            <span v-if="!isLogin">
                <a href="/#home"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="/#HowItWorks"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">How
                                    it works</a>
                <a href="/#Benefits"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Benefits</a>
                <a href="/#Features"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Features</a>

            </span>
            <span v-else>
                <router-link to="/dashboard"
                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                    aria-current="page">الرئيسية</router-link>
                <router-link to="/users" v-if="getRole() == 'admin' || getRole() == 'TechnicalAssistant'"
                    class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">المستخدمين</router-link>

            </span>
           
        </div>
    </nav>
</header>

</template>
<script>
import { getRole } from '@/Mixins/authMixin.js';
export default {
    props: {
        isLogin: Boolean
    }, data() {
        return {
            isMobileMenuOpen: false
        };
    },
    methods: {
        toggleMobileMenu() {
            this.isMobileMenuOpen = !this.isMobileMenuOpen;
        },
        getRole,
        logout() {
            this.$emit('logout');
        }
    }
}
</script>