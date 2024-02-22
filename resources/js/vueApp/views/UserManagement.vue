<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">قائمة المستخدمين <span class="text-muted fw-normal ms-2">({{ this.users.length
                    }})</span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <ul class="nav nav-pills">
                            <!-- <li class="nav-item">
                                <a aria-current="page" href="#"
                                    class="router-link-active router-link-exact-active nav-link active"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="List"
                                    aria-label="List">
                                    <i class="bx bx-list-ul"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Grid" aria-label="Grid"><i class="bx bx-grid-alt"></i></a>
                            </li> -->
                        </ul>
                    </div>
                    <div>
                        <router-link class="nav-link" to="/signup"><i class="bx bx-plus me-1"></i> اضافة مستخدم
                        </router-link>
                    </div>
                    <!-- <div class="dropdown">
                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                class="bx bx-dots-horizontal-rounded"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4" style="width: 50px;">
                                        <div class="form-check font-size-16"><input type="checkbox" class="form-check-input"
                                                id="contacusercheck" /><label class="form-check-label"
                                                for="contacusercheck"></label></div>
                                    </th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">الدور</th>
                                    <th scope="col">البكجات</th>
                                    <th scope="col">الايميل</th>
                                    <th scope="col">رقم الهاتف</th>
                                    <th scope="col">عدد النقاط</th>
                                    <th scope="col">حالة الحساب </th>
                                    <th scope="col" style="width: 200px;">اجراءات</th>
                                </tr>
                            </thead>
                            <!-- badge-soft-success 
                            badge-soft-info
                            badge-soft-danger
                            badge-soft-primary
                        -->
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <th scope="row" class="ps-4">
                                        <div class="form-check font-size-16"><input type="checkbox" class="form-check-input"
                                                id="contacusercheck1" /><label class="form-check-label"
                                                for="contacusercheck1"></label></div>
                                    </th>
                                    <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""
                                            class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">{{
                                                user.name }}</a></td>
                                    <td><span class="badge  mb-0" :class="badgeClass(user.packagesType,user.role)" >{{ user.role + ''}} <span v-if="user.role=='doctor'"> {{ getPackagesType(user.packagesType) }}  </span></span></td>
                                    <td>{{ user.packagesType }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.total_points }}</td>
                                    <td>{{ user.is_active==1 ? 'نشط' : "غير فعال" }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">

                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete" class="px-2 text-danger"><i
                                                        class="bx bx-trash-alt font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="nav-link  bx bx-pencil font-size-18" href="#" id="navbarDropdown"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <button type="button" class="dropdown-item btn btn-primary"
                                                        data-toggle="modal" data-target="#showPermissions"
                                                        @click="showUserPermissions(user.permissions.join('-'))">عرض
                                                        الصلاحيات</button>
                                                    <button type="button" class="dropdown-item btn btn-primary"
                                                        data-toggle="modal" data-target="#addPoints"
                                                        @click="setUserToaddPoint(user.id )">
                                                        اضافة نقاط</button>
                                                    <a class="dropdown-item" v-if="user.role != 'admin'"
                                                        @click="activation(user.id, user.is_active)">{{ user.is_active == 1 ? 'ايقاف التنشيط' : " تفعيل" }}</a>
                                                    <a class="dropdown-item" v-if="user.role != 'admin' &&  getPackagesType(user.packagesType)=='No Packages' "
                                                        @click="grantingTrialPeriod(user.id)"> {{ 'منح نسخة تجريبية '}}</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row g-0 align-items-center pb-4">
            <div class="col-sm-6">
                <div>
                    <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
                </div>
            </div> -->
        <!-- <div class="col-sm-6">
                <div class="float-sm-end">
                    <ul class="pagination mb-sm-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div> 
        </div> -->
    </div>
    <PopUp :title="'صلاحيات'" :message="shwnUserPermissions" :inputs="[]" :action="''" :ModalName="'showPermissions'" />
    <PopUp :title="'اضافة نقاط '" :message="'حدد النقاط التي ترغب باظافتها'" :inputsName="['points','cost','pointsType']" :inputsType="['text','text','select']" :selectOptions="[['basic', 'advanced']]" :action="'addPoints'" @addPoints="addPoints" :ModalName="'addPoints'" />
</template>

<script>
import { fetchData, postData } from '@/router/requestActions.js';
import PopUp from '@/components/PopUp.vue';


export default {
    components: {
        PopUp
    },
    data() {
        return {
            countOfUsrs: 0,
            popUpTiltle: "",
            popUpMassege: "",
            users: [],
            userToaddPoint: '',
            shwnUserPermissions:'',
        }
    },
    created() {
        this.getUsers();
    },
    methods: {
        setUserToaddPoint(id){
            this.userToaddPoint=id;
        },
        async addPoints( points, cost, type){
            
            try {
                let url="payments/add-points-to-user";
                var response = await postData(url, {
                    id:this.userToaddPoint,
                    points:points,
                    cost:cost,
                    pointsType:type,

                });
                    this.getUsers();
                }
            catch (error) {
                console.log(error);
            }
        },
        async activation (id,is_active){
            try {
                let url="auth/activate";
                if(is_active==1){
                    url="auth/deactivate";
                }
                var response = await postData(url, {
                    id:id});
                    console.log(response)
                    this.getUsers();
                }
            catch (error) {
                console.log(error);
            }
            
        },
        badgeClass(packagesType,role){
            if(role=='admin')
              return " badge-soft-primary" ;
             if(role=='TechnicalAssistant')
              return "badge-soft-info" ;
            switch(this.getPackagesType(packagesType)){
                case 'trial':
                    return "badge-secondary";
                case 'paid' : 
                     return "badge-soft-success";
                default :
                return "badge-warning";
                
            }   
            
                
        },
        async grantingTrialPeriod(user_id){
            try {
                let url="payments/granting-trial-period";
                var response = await postData(url, {
                    id:user_id});
                    console.log(response)
                    this.getUsers();
                }
            catch (error) {
                console.log(error);
            }

        },
        
        takedTrial(packagesType){
            
            const regex = /\btrial\b/i; // \b indicates a word boundary, i for case-insensitive matching

            // Test if the text contains the word "trial"
            const containsTrial = regex.test(packagesType);
            return containsTrial?true : false ;

        },
        getPackagesType(packagesType){
            if(packagesType==null)
            return 'No Packages'
            const regex = /\bpaid\b/i; // 

            // Test if the text contains the word "trial"
            const containsPaid  = regex.test(packagesType);
            if(containsPaid){
                return 'paid'
            }
            if (this.takedTrial) {
                return 'trial' 
            }
        }

        ,
        async getUsers() {
            try {
                this.users = await fetchData('point-management/users-with-points');
            }
            catch (error) {
                this.errorMessage = "request  failed";
            }
        },
        showUserPermissions(permissions) {
            this.popUpTiltle = "الصلاحيات";
            this.shwnUserPermissions = permissions;
        }
    }
}
</script>
<style scoped> body {
     margin-top: 20px;
     background-color: #eee;
 }

 .project-list-table {
     border-collapse: separate;
     border-spacing: 0 12px
 }

 .project-list-table tr {
     background-color: #fff
 }

 .table-nowrap td,
 .table-nowrap th {
     white-space: nowrap;
 }

 .table-borderless>:not(caption)>*>* {
     border-bottom-width: 0;
 }

 .table>:not(caption)>*>* {
     padding: 0.75rem 0.75rem;
     background-color: var(--bs-table-bg);
     border-bottom-width: 1px;
     box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
 }

 .avatar-sm {
     height: 2rem;
     width: 2rem;
 }

 .rounded-circle {
     border-radius: 50% !important;
 }

 .me-2 {
     margin-right: 0.5rem !important;
 }

 img,
 svg {
     vertical-align: middle;
 }

 a {
     color: #3b76e1;
     text-decoration: none;
 }

 .badge-soft-danger {
     color: #f56e6e !important;
     background-color: rgba(245, 110, 110, .1);
 }

 .badge-soft-success {
     color: #63ad6f !important;
     background-color: rgba(99, 173, 111, .1);
 }

 .badge-soft-primary {
     color: #3b76e1 !important;
     background-color: rgba(59, 118, 225, .1);
 }

 .badge-soft-info {
     color: #57c9eb !important;
     background-color: rgba(87, 201, 235, .1);
 }

 .avatar-title {
     align-items: center;
     background-color: #3b76e1;
     color: #fff;
     display: flex;
     font-weight: 500;
     height: 100%;
     justify-content: center;
     width: 100%;
 }

 .bg-soft-primary {
     background-color: rgba(59, 118, 225, .25) !important;
 }</style>