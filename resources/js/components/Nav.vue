<template>
    <header>
        <nav class="container">


            <ul class="">
                <li>
                    <h2 class="logo">Logo</h2>
                </li>
                <li 
                
                 v-for="(link, i) in navLinks" :key="i">
                    <router-link :to="{ name: link.name }">{{ link.text }}</router-link>
                </li>


            </ul>

            
        </nav>
    </header>
</template>

<script>
export default {
    data() {
        return {
          
         
            navLinks: [
                {
                    text: 'Home',
                    path: '/',
                    name: 'home'
                },
                {
                    text: 'Chi Siamo',
                    path: '/contatti',
                    name: 'contact-us'
                },
                {
                    text: 'Blog',
                    path: '/post',
                    name: 'post'
                }
            ]
        }
    }
}
</script>



<style lang="scss" scoped>
ul {
    list-style: none;
    display: flex;
    justify-content: space-around;
    align-items: center;
    font-size: 1.5rem;
  
}

</style>