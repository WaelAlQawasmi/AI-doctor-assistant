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
                                <img :src="doctorAi"
                                    class="user-profile-image rounded-circle" alt="" />
                                <h4 class="text-center h6 mt-2">اسم الطبيب</h4>
                                <p class="text-center small">الاختصاص</p>
                                <button class="btn btn-theme btn-sm">البريد الالكتروني</button>
                            </div>
                            <hr />
                            <div class="card-heading clearfix ">
                                <h4 class="card-title"> البكجات المتوفرة</h4>
                            </div>
                            <div class=" ">
                                <a href="#" class="label label-success mb-2"> الاساسي </a>

                                <!-- <a href="#" class="label label-success">الدواء الثاني</a> -->
                            </div>
                             <hr />
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title"> النشاطات  </h4>
                            </div>
                            <div class="card-body mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">شراء بكجات     <span class="badge badge-primary badge-pill">2</span></li>
                                    <li class="list-group-item">استشارات <span class="badge badge-primary badge-pill">7</span></li>
                                    <li class="list-group-item">عمليات دخول <span class="badge badge-primary badge-pill">5</span></li>
                                    <li class="list-group-item">  الاستئارات المتبقية <span class="badge badge-primary badge-pill">4</span></li>
                                </ul>
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
                                <form class="post"  @submit.prevent="getAiResponse">
                                    <textarea class="form-control" placeholder="الحالة المرضية" rows="4"></textarea>
                                    <div class="post-options">
                                        <!-- <a href="#"><i class="fa fa-camera"></i></a>
                                        <a href="#"><i class="fas fa-video"></i></a>
                                        <a href="#"><i class="fa fa-music"></i></a> -->
                                        <button type="submit" class="btn btn-outline-primary float-right">اسأل</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="profile-timeline">
                            <ul class="list-unstyled">
                                <li class="timeline-item">
                                    <div class="card card-white grid-margin" style="height: 97%;">
                                        <div class="card-body">
                                            <img v-if="showAi" :src="botImage"  class="ml-5" height="200" alt="logo" style="position: relative;right: 34%;">

                                            <div v-if="binding.length >0" v-for="(item, index) in AiResponseElement " :key="index" class="timeline-comment">
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

import { fetchData, postData } from '@/router/requestActions.js';
export default {
    data() {
        return {
           AiResponseElement:['التشخيص الاولي','الامراض المتوقعة','المرض المرجح','الفحوصات المقترحة','الادوية المقترحة','النصائح الطبية'],
           binding:[],
            ExpectedIllness: "",
            LikelyIllness: "",
            InitialGiagnosis: "",
            SuggestedMedications: "",
            RequiredTests: "",
            MedicalAdvice: "",
            symptoms: "",
            botImage,
            showAi:false,
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
        getBadge(index){
            switch (index)
            {
                case 0 : return "badge-info";
              //  case 1 : return "badge-warning";
                case 2 : return "badge-danger" ;        
                case 4 : return "badge-success" ;        
            }

        },
        async getAiResponse() {
            this.showAi=true;
            try {
                var medicalDiagnosis =this.testData// await postData('medical-diagnosis/', { symptoms: this.symptoms });
                console.log(medicalDiagnosis);
                this.ExpectedIllness = medicalDiagnosis['الامراض المتوقعة'].join('-');
                this.LikelyIllness = medicalDiagnosis['المرض المرجح'];
                this.MedicalAdvice = medicalDiagnosis['النصيحة الطبية'];
                this.RequiredTests = medicalDiagnosis['الفحوصات المطلوبة'].join('-');
                this.InitialGiagnosis = medicalDiagnosis['التشخيص'];
                this.SuggestedMedications = medicalDiagnosis['الادوية المقترحة'].join('-');
                this.binding=[this.InitialGiagnosis,this.ExpectedIllness,this.LikelyIllness,this.RequiredTests,this.SuggestedMedications,this.MedicalAdvice];

            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }
            this.showAi=false;


        },
        async getUser() {
            try {

                var userData = await fetchData('main-page/userProfile');
                this.name = userData.name
            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }

        },
        logout(){
            this.$emit('logout');
        }
    }
}
</script>

<style scoped>
* {
    text-align: right !important;
}

@import '@/css/dashboard.css';
</style>