<template>
    <div class="container p-4" dir="rtl">
        <div class="row gutters">
            <div class="col-xl-8 col-lg-8 card-body  ">
                <ul class="list-unstyled">
                    <li class="timeline-item">
                        <div class="card card-white grid-margin">
                            <div class="card-body">
                                <div class="timeline-item-header">
                                    <h1 style=" text-align: center;"> المساعد الطبي </h1>
                                </div>
                                <div class="timeline-item-post">
                                    <p> اهلاً بك في نظام الذكاء الصناعي المساعد للطبيب المختص
                                        املا بياناتك للتسجيل في النظام و سيتم التواصل معك من قبل فريقنا في اسرع وقت ممكمن
                                    </p>

                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>



            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">

                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary"> المعلومات الشخصية للطبيب </h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">الاسم الكامل</label>
                                    <input type="text" class="form-control" id="name" v-model="name" name="name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">الايميل</label>
                                    <input type="email"  v-model="email" name="email" class="form-control" id="eMail">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" v-model="phone" name="phone" class="form-control" id="phone">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">الاختصاص الطبي</label>
                                    <input type="text" v-model="specialty" name="specialty" class="form-control" id="website">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">الرقم السري</label>
                                    <input type="password"  v-model="password" name="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div  v-if ="getRole()=='admin'" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">الدور</label>
                                    <select class="custom-select"  v-model="role" name="role">
                                        <option selected value="doctor">طبيب</option>
                                        <option value="TA">تقني</option>
                                        <option value="Admin">مدير</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">عنوان العيادة</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">العنوان</label>
                                    <input type="name"  v-model="location" name="location" class="form-control" id="Street">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">المدينة</label>
                                    <input type="name" v-model="city" name="city" class="form-control" id="ciTy">
                                </div>
                            </div>
                           
                            </div>
                           

                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">

                                    <button @click="signup" type="button" id="submit" name="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
</template>


<script>
import { getRole } from '@/Mixins/authMixin.js';
import {  postData } from '@/router/requestActions.js';  

export default {
    data(){
        return{
            name:'',
            email:'' ,
            phone:'',
            password:'' ,
            location:'',
            city :'',
            role:'doctor',
            specialty:'',

        }
    },
    methods:{
        async signup(){
           
            try{
                var response=  await postData('auth/signup',{
                    email:this.email,
                    password: this.password,
                    name:this.name,
                    phone:this.phone,
                    specialty:this.specialty,
                    role:this.specialty,
                    city:this.city,
                    location:this.location
                });
                console.log(response.response.data);
                console.log(this.name, this.email ,  this.phone , this.password,  this.location, this.city , this.role, this.specialty);
            }
            catch (error) {
                console.log(error.response.data);
                this.errorMessage="Authentication failed";
            }
        },
        getRole
    }
    // name: 'signup',
};
</script>

<style scoped>
.container {
    margin: 0;
    padding-top: 40px;
    color: #2e323c;
    position: relative;
    height: 100vh;
    width: 100;
}

* {
    text-align: right;
}

@import '@/css/signup.css';</style>