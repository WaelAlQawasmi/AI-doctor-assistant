<template>
    <h1> {{name  }} مرحبا</h1>
    <p>اهلاً بك في المساعد الشخصي للطبيب</p>
<form @submit.prevent="getAiResponse" >
    <textarea   name="symptoms" v-model="symptoms" placeholder="الاعراض التي يعاني منها المريض">
    </textarea>
    <button type="submit">ارسل</button>
</form>
<ul>
    <li><span>  المرض المتوقع</span> {{ ExpectedIllness }}</li>
    <li><span>  المرض المرجح</span> {{ LikelyIllness }}</li>
    <li><span> التشخيص الاولي </span> {{ InitialGiagnosis }}</li>
    <li><span>  الادوية المقترحة</span> {{ SuggestedMedications }}</li>
    <li><span>  الفحوصات المطلوبة</span> {{ RequiredTests }}</li>
    <li><span>  نصائح طبية</span> {{ MedicalAdvice }}</li>
 
</ul>
</template>
<script>
import { fetchData ,postData } from '@/router/requestActions.js';  

export default {
    data() {
        return {
            ExpectedIllness:"",
            LikelyIllness:"",
            InitialGiagnosis:"",
            SuggestedMedications:"",
            RequiredTests:"",
            MedicalAdvice:"",
            symptoms:"",
        }
    },
    created(){
        this.getUser();
    }
    ,
    methods:{ 
     async getAiResponse (){
        try{
            var medicalDiagnosis=  await postData('medical-diagnosis/',{symptoms:this.symptoms});
            console.log(medicalDiagnosis);
            this.ExpectedIllness=medicalDiagnosis['الامراض المتوقعة'].join('-');
            this.LikelyIllness=medicalDiagnosis['المرض المرجح'];
            this.MedicalAdvice=medicalDiagnosis['النصيحة الطبية'];
            this.RequiredTests=medicalDiagnosis['الفحوصات المطلوبة'].join('-');
            this.InitialGiagnosis=medicalDiagnosis['التشخيص'];
            this.SuggestedMedications=medicalDiagnosis['الادوية المقترحة'].join('-');
        }
        catch (error) {
            this.errorMessage="Authentication failed";
        }

     },
      async  getUser(){ 
            try{
            
                var userData=  await fetchData('main-page/userProfile');
                this.name= userData.name
            }
            catch (error) {
                this.errorMessage="Authentication failed";
            }

        }
    }
}
</script>