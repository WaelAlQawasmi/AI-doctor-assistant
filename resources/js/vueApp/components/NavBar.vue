<template>
    <nav v-if="isAuth" class="navbar navbar-expand-lg navbar-light bg-light" style="direction: rtl; ">
        <a class="navbar-brand" href="#">دكتور صناعي</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">الرئيسية </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/users">المستخدمين </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">اعدادات</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" @click="logout">خروج</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    props: {
        isAuth: Boolean,
    },
    methods: {
        logout() {
            this.$emit('logout');
        }
    }
}
</script>