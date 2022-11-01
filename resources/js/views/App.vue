<template>
    <div>
        <div class="container">

            <h1>
                {{ title }}
            </h1>
        </div>
        <div class="container">

            <div class="cards">
                <PostCard v-for='post in posts' :key='post.id' :post="post" />
            </div>
        </div>

        <div class="container">
            <!-- qui link delle pagine quindi avere totp post alle pagine -->
            <ul class="page">
                <li :class="{
                    'active': page === currentPage
                }" v-for="page in lastPage" :key="page" @click="fetchPosts(page)">{{ page }}</li>
            </ul>
        </div>
    </div>

</template>



<script>
import PostCard from '../components/PostCard.vue';

export default {
    components: {
        PostCard
    },
    data() {
        return {
            title: 'Js disse: Sono Tornatoooooooooo',
            posts: [],
            currentPage: 1,
            lastPage: 0,
            total: 0
        }
    },
    methods: {
        fetchPosts(page = 1) {
            axios.get('/api/posts', {
                params: {
                    page: page
                }
            }).then((res) => {

                // const { posts } = res.data
                // this.posts = posts
                console.log(res.data)
                const { data, current_page, last_page, total } = res.data.result
                this.posts = data
                this.lastPage = last_page
                this.currentPage = current_page
                this.total = total
                console.log(this.currentPage)

            })

        }
    },

    beforeMount() {
        this.fetchPosts()

    }
}

</script>



<style scoped lang="scss">
.cards {

    text-align: center;
}

.active {
    background-color: yellowgreen;
}

.page {
    display: flex;
    justify-content: space-around;
    list-style: none;

    li {
        border: 1px solid black;
        padding: 10px;
        border-radius: 15px;
        font-size: 2rem;
        &:hover{
            cursor: pointer;
            background-color: yellowgreen;
            scale: 1.5;
            color: white;
            

        }
       

    }
    
}
</style>

