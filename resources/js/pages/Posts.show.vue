<template>
    <div class="posts__show" v-if="post" :style="{ backgroundImage: `url(${post.cover_path})` }">
        <section>
            <div class="container">
                <h1>dettaglio articolo</h1>
                <!-- <p>{{$scopedSlots.params.slug}}</p> -->
                <p>{{ slug }}</p>
                <!-- <img v-if="post.cover" :src="post.cover_path" alt=""> -->


                <h3>Titolo del post : {{ post.title }}</h3>
                <p>Creato il {{ post.date }}</p>
                <h4 v-if="post.category">Categoria={{ post.category?.name }}</h4>
                <Tags :tags="post.tags" />
                Contenuto: <div v-html="post.content"> </div>
            </div>
        </section>
    </div>
</template>
 
<script>
import Tags from '../components/Tags.vue'



export default {
    props: ["slug"],
    data() {
        return {
            post: null
        };
    },
    methods: {
        fetchPost() {
            // const slug= this.$route.params.slug
            axios.get(`/api/posts/${this.slug}`).then(res => {
                console.log(res.data);
                console.log("chiamata fatta");
                const { post } = res.data;
                this.post = post;
            }).catch(err => {
                console.log(err.response);
                console.log("Non va");
                const { status } = err.response;
                //redirect a pagina 404
                if (status === 404) {
                    this.$router.replace({ name: "404" }); //andava bene anche il push sul replace
                    //il replace non ti fa tornare indietro ma a un passo prima
                }
            });
        }
    },
    beforeMount() {
        // console.log(this.$router)
        this.fetchPost();
    },
    components: { Tags }
}
</script>
 
<style scoped lang="scss">
.posts__show {
    background-repeat: no-repeat;
    background-size: contain;

    background-position: center;


}
</style>