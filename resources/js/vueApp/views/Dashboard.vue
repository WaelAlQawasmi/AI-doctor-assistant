<template>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="page-inner no-page-title">
            <!-- start page main wrapper -->
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-xl-3">
                        <div class="card card-white grid-margin">
                            <div class="card-heading clearfix">
                                <h4 class="card-title"> معلومات الطبيب</h4>
                            </div>
                            <div class="card-body user-profile-card mb-3">
                                <img :src="doctorAi" class="user-profile-image rounded-circle" alt="" />
                                <h4 class="text-center h6 mt-2">{{ name }} </h4>
                                <p class="text-center small" v-if="specialty = ''"> {{ specialty }}</p>
                                <p class="text-center small"> {{ email }}</p>
                                <p class="text-center small"> {{ phone }}</p>

                                <!-- <button class="btn btn-theme btn-sm">البريد الالكتروني</button> -->
                            </div>
                            <hr />
                            <div class="card-heading clearfix ">
                                <h4 class="card-title"> البكجات المتوفرة</h4>
                            </div>
                            <div class=" ">
                                <div class="alert alert-primary" v-if="!hasPoints" role="alert">لا يوجد لديك نقاط </div>

                                <a v-for="(item, index) in pointsPackages " class="  mb-2 text-white"
                                    :class="item.point_type == 'trial' ? 'badge badge-warning' : 'label label-success'"> {{
                                        item.point_type }} - {{ item.points }} </a>
                            </div>
                            <hr />
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title"> النشاطات </h4>
                            </div>
                            <div class="card-body mb-3">
                                <!-- <ul class="list-group list-group-flush">
                                    <li class="list-group-item">شراء بكجات     <span class="badge badge-primary badge-pill">2</span></li>
                                    <li class="list-group-item">استشارات <span class="badge badge-primary badge-pill">7</span></li>
                                    <li class="list-group-item">عمليات دخول <span class="badge badge-primary badge-pill">5</span></li>
                                    <li class="list-group-item">  الاستئارات المتبقية <span class="badge badge-primary badge-pill">4</span></li>
                                </ul> -->
                                <div class="card-body px-5 py-4">
                                    <button type="button" @click="logout" class="btn btn-outline-danger">خروج</button>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="col-lg-9 col-xl-9">
                        <div class="card card-white grid-margin">
                            <div class="card-body">
                                <form class="post" @submit.prevent="getAiResponse" v-if="hasPoints">
                                    <div class="custom-control custom-radio custom-control-inline">

                                        <input type="radio" id="customRadioInline1" v-model="gender" value="ذكر"
                                            name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1"> ذكر</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" v-model="gender" value="انثى"
                                            name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">انثى</label>
                                    </div>
                                    <div class="post-options"></div>
                                    <textarea class="form-control" v-model="symptoms" placeholder="الحالة المرضية"
                                        rows="4"></textarea>
                                    <div class="post-options"></div>
                                    <textarea class="form-control" v-model="oldResults" placeholder=" نتائج فحوصات"
                                        rows="4"></textarea>
                                    <div class="post-options"></div>
                                    <textarea class="form-control" v-model="affectFactors"
                                        placeholder=" عوامل مؤثرة كالحمل او طبيعة غذاء او عمل" rows="4"></textarea>
                                    <div class="post-options"></div>

                                    <textarea class="form-control" v-model="history" placeholder=" تاريخ المرضي"
                                        rows="4"></textarea>
                                    <div class="post-options">
                                        <!-- <a href="#"><i class="fa fa-camera"></i></a>
                                            <a href="#"><i class="fas fa-video"></i></a>
                                            <a href="#"><i class="fa fa-music"></i></a> -->
                                        <button tpe="submit" class="btn btn-outline-primary float-right">اسأل</button>
                                    </div>
                                </form>
                                <div class="alert alert-primary" v-else role="alert">لا يوجد لديك نقاط لإستشارة الذكاء
                                    الصناعي يرجى طلب نقاط لتتمكن من المواصلة</div>
                            </div>
                        </div>
                        <div class="profile-timeline">
                            <ul class="list-unstyled">
                                <li class="timeline-item">
                                    <div class="card card-white grid-margin" style="height: 97%;">
                                        <div class="card-body" id="aiBot">
                                            <img v-if="showAi" :src="botImage" class="ml-5" height="200" alt="logo" 
                                                style="position: relative;right: 34%;">
                                            <div v-if="binding.length > 0" v-for="(item, index) in medicalDiagnosisKeys "
                                                :key="index" class="timeline-comment">
                                                <div class="timeline-comment-header">
                                                </div>
                                                <p class="badge badge-pill" :class="getBadge(index)"> {{ item }} </p>

                                                <p class="timeline-comment-text"> {{ binding[index] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import botImage from '@/img/bot.gif';
import doctorAi from '@/img/doctorAi.png';
import { getRole } from '@/Mixins/authMixin.js';

import { fetchData, postData } from '@/router/requestActions.js';
export default {
    emits: ['logout', 'login'],

    data() {
        return {
            gender: '',
            oldResults: '',
            affectFactors: '',
            history: '',
            symptoms: "",

            medicalDiagnosisKeys: [],

            hasPoints: false,
            pointsPackages: {},
            phone: "",
            email: "",
            binding: [],
            specialty: '',

            botImage,
            showAi: false,
            doctorAi,
            testData: {
                "الادوية المقترحة": [
                    'مضاد حيوي - Augmentin 625mg tablet مرتين يوميًا لمدة أسبوع',
                    'مضاد التهاب - Ibuprofen 400mg tablet ثلاث مرات يوميًا لمدة أسبوع'
                ],
                "الامراض المتوقعة": [
                    'التهاب رئوي',
                    'سرطان الرئة',
                    'نقص الأكسجين في الدم'
                ],
                "التشخيص": "التهاب رئوي بسبب عدوى بكتيرية",
                "الفحوصات المطلوبة": [
                    'أشعة مقطعية للرئة',
                    'فحص دم',
                    'زراعة للبلغم'
                ],
                "المرض المرجح": "التهاب رئوي",
                "النصيحة الطبية": "من الأفضل أن تبدأ في تناول الأدوية وتحافظ على راحة السرير والاستمرار في الراحة والاستراحة الجيدة وتناول السوائل الدافئة بكثرة."
            },
        }
    },
    created() {

        this.getUser();
    }
    ,
    methods: {
        getRole,
        getBadge(index) {
            if (index % 2 != 0)
                return '';
            switch (index) {
                case 0: return "badge-info";
                case 2: return "badge-danger";
                case 4: return "badge-success";

            }
            if (index % 2 == 0)
                return 'badge-info';


        },
        async getAiResponse() {
            this.showAi = true;
            const element = document.getElementById('aiBot');
                    element.scrollIntoView({ behavior: 'smooth' });
                    
            try {
                var medicalDiagnosis = this.testData// 
                var medicalDiagnosis = await postData('medical-diagnosis/', { symptoms: this.symptoms, gender: this.gender, history: this.history, affectFactors: this.affectFactors, oldResults: this.oldResults });
                console.log(medicalDiagnosis);
                this.medicalDiagnosisKeys = Object.keys(medicalDiagnosis);
                this.binding = this.medicalDiagnosisKeys.map(item => {
                    item = medicalDiagnosis[item];
                    if (Array.isArray(item)) {
                        return item.join('-');
                    } else {
                        return item;
                    }
                });
            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }
            this.getUser();
            this.showAi = false;
        },
        async getUser() {
            try {

                var userData = await fetchData('main-page/userProfile');
                this.name = userData.logedInUser.name
                this.email = userData.logedInUser.email
                this.phone = userData.logedInUser.phone
                this.pointsPackages = userData.points
                this.hasPoints = userData.points.length != 0 || getRole() == 'admin';

            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }

        },
        logout() {
            this.$emit('logout');
        }
    }
}
</script>

<style scoped>* {
    text-align: right !important;
}

@import '@/css/dashboard.css';</style>