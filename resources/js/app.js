/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import routes from "./routes";


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const router = new VueRouter({
    mode:"history",
    routes : routes
});

// Vue.component("navbar", require("./components/navbar.vue").default);
Vue.component("navbar-component", require("./Maincomponents/navbar.vue").default);
// Vue.component("small-navbar-component", require("./Maincomponents/small_nav.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
function isLoggedIn() {
    return localStorage.getItem("isLoggedIn");
}

router.beforeEach((to,from,next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){
        if (!isLoggedIn()) {
            next({
                name: "login"
            });
        } else {
            next();
        }
    }
    else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: "transaction"
            });
        } else {
            next();
        }
    }
    else{
        next();
    }

});

const app = new Vue({
    router,
    data() {
        return {
            navbarlinks: [
                { link: "/login", label: "Login" },
                { link: "/register", label: "Sign Up" },
                { link: "/transaction" , label: "Transaction"},
                { link: "/wallet" , label: "Wallet"},
                { link: "/graph" , label: "Graph"}
            ]
        };
    }
}).$mount("#app");
