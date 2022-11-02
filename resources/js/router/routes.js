import Home from "../pages/Home.vue" ;
import ContactUs from "../pages/ContactUs.vue" ;
import Post from "../pages/Post.vue" ;
import PostsShow from "../pages/Posts.show.vue" ;

const routes = [
    {
      path:'/',
      name:'home',
      component:Home,
    },
    {
        path:'/contatti',
        name:'contact-us',
        component:ContactUs,
      },
      {
        path:'/post',
        name:'post',
        component:Post,
      },
      {
        path:'/post/:slug',
        name:'posts.show',
        component: PostsShow,
        props:true,
      }
  ];

  export default routes;