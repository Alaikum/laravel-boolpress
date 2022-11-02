<template>
    <div>
        <Nav />
        <router-view></router-view>

    </div>

</template>



<script>
import Nav from "../components/Nav.vue";
import PostCard from '../components/PostCard.vue';

export default {
    components: {
        PostCard,
        Nav
    },
    data() {
        return {

        }
    },
    methods: {



    },

    beforeMount() {


    }
}

</script>



<style scoped lang="scss">
.active {
    background-color: yellowgreen;
}
</style>

