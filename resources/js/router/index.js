import Vue from "vue";
import VueRouter from "vue-router";
import routes from './routes';

Vue.use(VueRouter)

//history ha url standard
const router = new VueRouter({
    mode: 'history',
    //gli passo le rotte
    routes: routes,
  })

  export default router;