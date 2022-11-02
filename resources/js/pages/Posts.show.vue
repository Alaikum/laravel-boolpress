<template>
    <div>
     <section>
         <div class="container">
         <h1>dettaglio articolo</h1>
         <!-- <p>{{$scopedSlots.params.slug}}</p> -->
         <p>{{slug}}</p>
         </div>
     </section>
    </div>
 </template>
 
 <script>
 
 
     export default {
         props:['slug'],
         data(){
             return{
                 post: null
             }
         },
         methods:{
             fetchPost(){
                 // const slug= this.$route.params.slug
                 axios.get(`/api/posts/${this.slug}`).then(res=>{
                     console.log(res.data)
                     console.log('chiamata fatta')
                 }).catch(err=>{
                     console.log(err)
                     console.log('Non va')
                 })
             }
         },
         beforeMount(){
             // console.log(this.$router)
            this.fetchPost()
     
         }
       
     }
 </script>
 