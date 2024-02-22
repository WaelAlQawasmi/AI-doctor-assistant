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
                                <h4 class="card-title" > معلومات الطبيب</h4>
                            </div>
                            <div class="card-body user-profile-card mb-3" >
                                <img :src="doctorAi" class="user-profile-image rounded-circle" alt="" style=" display: inline-block;" />
                                <span id="dr_info">
                                    <h4 class="text-center h6 mt-2">{{ name }} </h4>
                                    <p class="text-center small" v-if="specialty = ''"> {{ specialty }}</p>
                                    <p class="text-center small"> {{ email }}</p>
                                    <p class="text-center small"> {{ phone }}</p>
                                </span>

                                <!-- <button class="btn btn-theme btn-sm">البريد الالكتروني</button> -->
                            </div>
                            <hr />
                            <div class="card-heading clearfix ">
                                <h4 class="card-title" id="step2"> البكجات المتوفرة</h4>
                            </div>
                            <div class=" " id="avalible-packages">
                                <div class="alert alert-primary" v-if="!hasPoints" role="alert">لا يوجد لديك نقاط </div>

                                <a v-for="(item, index) in pointsPackages " class="  mb-2 text-white"
                                    :class="item.point_type == 'trial' ? 'badge badge-warning' : 'label label-success'"> {{
                                        item.point_type }} - {{ item.points }} </a>
                            </div>
                            <hr />
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title" id="activites"> النشاطات </h4>
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
                                    <div class="custom-control custom-radio custom-control-inline" id="sex">

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
                                    <textarea id="case" required class="form-control" v-model="symptoms" placeholder="الحالة المرضية"
                                        rows="4"></textarea>
                                    <div class="post-options"></div>
                                    <textarea id="tests" class="form-control" v-model="oldResults" placeholder=" نتائج فحوصات"
                                        rows="4"></textarea>
                                    <div class="post-options"></div>
                                    <textarea id="effectedFactory" class="form-control" v-model="affectFactors"
                                        placeholder=" عوامل مؤثرة كالحمل او طبيعة غذاء او عمل" rows="4"></textarea>
                                    <div class="post-options"></div>

                                    <textarea  id="history" class="form-control" v-model="history" placeholder=" تاريخ المرضي"
                                        rows="4"></textarea>
                                    <div class="post-options">
                                        <!-- <a href="#"><i class="fa fa-camera"></i></a>
                                            <a href="#"><i class="fas fa-video"></i></a>
                                            <a href="#"><i class="fa fa-music"></i></a> -->
                                        <button tpe="submit" class="btn btn-outline-primary float-right">اسأل</button>
                                    </div>
                                    <div  id="AdvancedReponse" class="customCheckBoxHolder">
                                        <input type="checkbox" id="cCB1" class="customCheckBoxInput"
                                            :disabled="!isUserHasAccessToAdvancedReponse" v-model="AdvancedReponseChecked">
                                        <label for="cCB1" class="customCheckBoxWrapper  "
                                            :title="isUserHasAccessToAdvancedReponse ? 'ستحصل على اجابة عالية في الدقة كما سيتم خصم نقاط اعلى' : ' لا يوجد لديك نقاط متقدمة '">
                                            <div class="customCheckBox">
                                                <div class=" inner">اجابة عالية الدقة </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="alert alert-primary" v-if="!isUserHasAccessToAdvancedReponse" role="alert">
                                        لا يوجد لديك نقاط متقدمة </div>
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
                                            <img v-show="showAi" src="../img/bot.gif" class="ml-5" height="200" alt="logo"
                                                style="position: relative;left: 25%;">
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
import introJs from 'intro.js';
import 'intro.js/introjs.css';


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
            AdvancedReponseChecked: false,
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
        startIntro() {
            const intro = introJs();
            intro.setOptions({
                steps: [
                    {   title: 'الطبيب',
                        element: '#dr_info',
                        intro: 'المعلومات الخاصة بالطبيب',
                    },
                    {
                        title: 'النقاط',
                        element: '#avalible-packages',
                        intro: 'النقاط المتوفرة و يتم الخصم منها بناء على نوع الاجابة المطلوبة',
                    },
                     {
                        title: 'النشاطات',
                        element: '#activites',
                        intro: 'النشاطات التي قام بها الطبيب مؤخراً',
                    },
                      {
                        title: 'الجنس',
                        element: '#sex',
                        intro: 'ير جى تحديد الجنس لان بعض التشخيصات تعتمد على الجنس كالحمل او غيرها ...' ,
                    },{
                        title: 'الحالة المرضية',
                        element: '#case',
                        intro: "يرجى ذكر جميع التفاصيل الحالة المرضية مما يعانيه او مما تعاينه كطبيب او اي تفاصيل اخرى تصف الحالة المرضية بشكل كامل",
                    },
                    {
                        title: ' الفحوصات',
                        element: '#tests',
                        intro: "  يرجى ذكر الفحوصات ذات الصلة ان وجدت للحالة المرضية  مع نتائجها لتعطي تشخيص ادق ",
                    },
                     {
                        title: ' عوامل مؤثرة',
                        element: '#effectedFactory',
                        intro: " برجى ذكر جميع العوامل المؤثرة او المؤدية لهذه الحالة  او العوامل ذات صلة  مثل الحمل  طبيعة عمل الشخص طبيعة غذائه  الظروف المحيطة الحواث مؤثرة ....",
                    }, {
                        title: '  التاريخ المرضي ذات الصلة',
                        element: '#history',
                        intro: "يرجى ذكر التاريخ المرضي ذات الصلة بالحالة المرضة و قد تؤثر بها مثل العمليات او الامراض او تاريخ مرضي اسري",
                    },{
                        title: ' اجابات عالية الدقة',
                        element: '#AdvancedReponse',
                        intro: " اذا كنت ترغب في اجابة عالية في الدقة  يرجى اختيار هذا الخيار  و يرجى التأكد من توفر نقاط متقدمة لاستخام هذه الميزة" ,
                    },
                    // Add more steps as needed
                ],
            });
            intro.start();
        },

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
        isUserHasAccessToAdvancedReponse() {
            if (getRole == 'admin')
                return true;
            let hasAccess = false;
            if (this.pointsPackages == null)
                return false
            const regex = /\badvanced\b/i; // 
            this.pointsPackages.forEach(element => {
                if (regex.test(element)) {
                    hasAccess = true;
                }
            });
            return hasAccess;
        }

        ,
        async getAiResponse() {
            this.showAi = true;
            const element = document.getElementById('aiBot');
            element.scrollIntoView({ behavior: 'smooth' });
            try {
                var medicalDiagnosis = this.testData// 
                var medicalDiagnosis = await postData('medical-diagnosis', { symptoms: this.symptoms, gender: this.gender, history: this.history, affectFactors: this.affectFactors, oldResults: this.oldResults, AdvancedReponse: this.AdvancedReponseChecked });
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
            setTimeout(1500,this.startIntro()) ;

        },
        logout() {
            this.$emit('logout');
        }
    }
}
</script>

<style scoped>
* {
    text-align: right !important;
}
</style>
<style  src="../css/dashboard.css"></style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.12.0/css/bootstrap-tour.min.css" rel="stylesheet">
