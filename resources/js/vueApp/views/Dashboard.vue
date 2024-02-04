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
                                <h4 class="card-title">  معلومات الطبيب</h4>
                            </div>
                            <div class="card-body user-profile-card mb-3">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                    class="user-profile-image rounded-circle" alt="" />
                                <h4 class="text-center h6 mt-2">اسم الطبيب</h4>
                                <p class="text-center small">الاختصاص</p>
                                <button class="btn btn-theme btn-sm">البريد الالكتروني</button>
                            </div>
                            <hr />
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title">الادوية المقترحة </h4>
                            </div>
                            <div class="card-body mb-3">
                                <a href="#" class="label label-success mb-2">الدواء الاول</a>
                                
                                <a href="#" class="label label-success">الدواء الثاني</a>
                            </div>
                            <hr />
                        
                          
                         
                        </div>
                    </div>
                    <div class="col-lg-9 col-xl-9">
                        <div class="card card-white grid-margin">
                            <div class="card-body">
                                <div class="post">
                                    <textarea class="form-control" placeholder="الحالة المرضية" rows="4"></textarea>
                                    <div class="post-options">
                                        <a href="#"><i class="fa fa-camera"></i></a>
                                        <a href="#"><i class="fas fa-video"></i></a>
                                        <a href="#"><i class="fa fa-music"></i></a>
                                        <button class="btn btn-outline-primary float-right">اسأل</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-timeline">
                            <ul class="list-unstyled">
                                <li class="timeline-item">
                                    <div class="card card-white grid-margin">
                                        <div class="card-body">
                                            <div class="timeline-item-header">
                                                <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" /> -->
                                                <p>التشخيص  </p>
                                            </div>
                                            <div class="timeline-item-post">
                                                <p>التشخيص</p>

                                                <div class="timeline-comment">
                                                    <div class="timeline-comment-header">
                                                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" /> -->
                                                        <p> المرض المتوقع </p>
                                                    </div>
                                                    <p class="timeline-comment-text">المرض المتوقع</p>
                                                </div>
                                                <div class="timeline-comment">
                                                    <div class="timeline-comment-header">
                                                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" /> -->
                                                    </div>
                                                    <p > نصائح طبية</p>

                                                    <p class="timeline-comment-text">نصائح طبية</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">

                                </li>
                            </ul>
                        </div>
                    </div>
                  
                </div>
                <!-- Row -->
            </div>
         
        </div>
    </div>



<!-- 
    <h1> {{ name }} مرحبا</h1>
    <p>اهلاً بك في المساعد الشخصي للطبيب</p>
    <form @submit.prevent="getAiResponse">
        <textarea name="symptoms" v-model="symptoms" placeholder="الاعراض التي يعاني منها المريض">
    </textarea>
        <button type="submit">ارسل</button>
    </form>
    <ul>
        <li><span> المرض المتوقع</span> {{ ExpectedIllness }}</li>
        <li><span> المرض المرجح</span> {{ LikelyIllness }}</li>
        <li><span> التشخيص الاولي </span> {{ InitialGiagnosis }}</li>
        <li><span> الادوية المقترحة</span> {{ SuggestedMedications }}</li>
        <li><span> الفحوصات المطلوبة</span> {{ RequiredTests }}</li>
        <li><span> نصائح طبية</span> {{ MedicalAdvice }}</li>

    </ul> -->
</template>
<script>
import { fetchData, postData } from '@/router/requestActions.js';

export default {
    data() {
        return {
            ExpectedIllness: "",
            LikelyIllness: "",
            InitialGiagnosis: "",
            SuggestedMedications: "",
            RequiredTests: "",
            MedicalAdvice: "",
            symptoms: "",
        }
    },
    created() {
        this.getUser();
    }
    ,
    methods: {
        async getAiResponse() {
            try {
                var medicalDiagnosis = await postData('medical-diagnosis/', { symptoms: this.symptoms });
                console.log(medicalDiagnosis);
                this.ExpectedIllness = medicalDiagnosis['الامراض المتوقعة'].join('-');
                this.LikelyIllness = medicalDiagnosis['المرض المرجح'];
                this.MedicalAdvice = medicalDiagnosis['النصيحة الطبية'];
                this.RequiredTests = medicalDiagnosis['الفحوصات المطلوبة'].join('-');
                this.InitialGiagnosis = medicalDiagnosis['التشخيص'];
                this.SuggestedMedications = medicalDiagnosis['الادوية المقترحة'].join('-');
            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }

        },
        async getUser() {
            try {

                var userData = await fetchData('main-page/userProfile');
                this.name = userData.name
            }
            catch (error) {
                this.errorMessage = "Authentication failed";
            }

        }
    }
}
</script>