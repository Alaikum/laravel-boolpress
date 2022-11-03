<template>
    <div>
        <h1>Errore 404</h1>
        <p>Ops pagina non trovata</p>
        <router-link :to="{ name: 'home' }">tornare alla home?</router-link>
        o
        <router-link :to="{ name: 'post' }">tornare al blog?</router-link>
    </div>

</template>
    
    
<script>
export default {

}
</script>
    
<style scoped lang="scss">
div {
    background-color: lightcoral;
    height: 100vh;
    font-size: 3rem;
    text-align: center;
}
</style>