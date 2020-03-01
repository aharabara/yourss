import Vue from "vue";
import VueRouter from 'vue-router'

import FormLogin from "./Components/UI/Form/Login";
import FormRegister from "./Components/UI/Form/Register";
import Feed from "./Components/UI/Feed";
import AccountingService from "./Components/Application/Services/AccountingService";

Vue.use(VueRouter);

const routes = [
  { path: '/login', component: FormLogin },
  { path: '/register', component: FormRegister },
  { path: '/feed', component: Feed },
];

const router = new VueRouter({
  routes
});

AccountingService.isLogged()
  .then(function(){ router.replace("/feed"); })
  .catch(function(){ router.replace("/login"); });

new Vue({
  router
}).$mount('#application');


