let routes = [
    {
        path: "/",
        name: "home",
        component: require("./components/home.vue").default
    },
    {
        path:"/register",
        name:"register",
        component: require("./components/register.vue").default,
        meta: { requiresVisitor: true }
    },
    {
        path:"/login",
        name:"login",
        component: require("./components/login.vue").default,
        meta: { requiresVisitor: true }
    },
    {
        path:"/register/s",
        name:"registerSuccess",
        component: require("./components/registersuccess.vue").default,
        meta: { requiresAuth: true }
    },
    {
        path:"/transaction",
        name:"transaction",
        component: require("./components/transaction.vue").default,
        meta: { requiresAuth: true }
    },
    {
        path:"/graph",
        name:"graph",
        component: require("./components/graph.vue").default,
        meta: { requiresAuth: true }
    },
    {
        path:"/wallet",
        name:"wallet",
        component: require("./components/wallet.vue").default,
        meta: { requiresAuth: true }
    },
];
export default routes;
