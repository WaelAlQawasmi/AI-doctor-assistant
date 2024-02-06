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
                                    <input type="text" class="form-control" id="fullName">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">الايميل</label>
                                    <input type="email" class="form-control" id="eMail">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" class="form-control" id="phone">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">الاختصاص الطبي</label>
                                    <input type="text" class="form-control" id="website">
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
                                    <input type="name" class="form-control" id="Street">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">المدينة</label>
                                    <input type="name" class="form-control" id="ciTy">
                                </div>
                            </div>

                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">

                                    <button type="button" id="submit" name="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
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