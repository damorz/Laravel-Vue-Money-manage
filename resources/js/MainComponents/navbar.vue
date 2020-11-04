<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-minimal-bg">
            <router-link
                to="/"
                class="navbar-brand"
                style="font-weight: bold; font-size:22px;color: black;"
                ><i class="fas fa-search-dollar" style="color: black;"></i>NubTung</router-link
            >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="color:black;">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar"  aria-expanded="false" aria-label="Toggle navigation">


                <ul class="navbar-nav ml-auto">

                    <li
                        @click="closeMenu"
                        v-for="(link, i) in links_filtered"
                        :key="i"
                        class="nav-item fonts-menu"
                    >
                        <router-link :to="link.link" class="nav-link" style="color: black;">
                            <i class="fas fa-chart-area" v-if="link.label == 'Graph'"></i>
                            <i class="fas fa-wallet" v-if="link.label == 'Wallet'"></i>
                            <i class="fab fa-bitcoin" v-if="link.label == 'Transaction'"></i>
                            <i class="fas fa-sign-in-alt" v-if="link.label == 'Login'"></i>
                            <i class="fas fa-file-signature" v-if="link.label == 'Sign Up'"></i>

                            {{ link.label }}
                        </router-link>
                    </li>
                    <li class="nav-item" >

                        <a class="nav-link pointer fonts-menu"  style="color: black;" @click="logout" v-if="isLoggedIn">
                            <i class="fas fa-sign-out-alt" ></i>
                            Logout
                        </a>
                    </li>

                </ul>
            </div>

        </nav>
    </div>

</template>

<script> // แก้ navbar ที่ login แล้ว barไม่เปลี่ยน
    export default {
        data() {
            return {
                isLoggedIn: false,
            };
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem("isLoggedIn");
        },
        props: {
            links: Array
        },
        computed: {
            links_filtered: function() {
                 // login แล้วต้องให้เห็นอะไร
                if (this.isLoggedIn) {
                    // return this.links;
                    return this.links.filter(
                        link => link.link !== "/login" && link.link !== "/register"
                    );
                }
                 // ไม่ login แล้วต้องเห็นอะไร
                else {
                    return this.links.filter(
                        link => link.link !== "/transaction" && link.link !== "/wallet" && link.link !== "/graph"
                    );
                }
            }
        },
        methods:{
            closeMenu() {
                $("#collapsibleNavbar").collapse("hide");
            },
            logout(){
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios.post('/api/user/logout').then(res => {
                        localStorage.removeItem('isLoggedIn','true');
                        this.$router.go({ name: "login" });
                    });
                });
            },
            home(){
                this.$router.push({name:'home'});
            }
        }
    }
</script>

<style>
    .pointer {
        cursor: pointer;

    }
    .round-btn{
        height: 40px;
        line-height: 10px;
        width:40px;
        font-size: 2em;
        font-weight: bold;
        border-radius: 50%;
        color: black;
        text-align: center;
        cursor: pointer;
    }
    .navbar-minimal-bg{
        background-color: #ffffff;
    }
    .fonts-menu{
        font-weight: bold;
        font-size: 18px;
    }
</style>
