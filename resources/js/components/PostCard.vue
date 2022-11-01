<template>
  <div>

    <div class="post">
      <img v-if="post.cover" :src="post.cover_path" alt="">
      <h3>{{ post.title }}</h3>
      <p> <strong>Creato il : </strong>{{ post.date }}</p>
      <p class="category" v-if="post.category"><i>Categoria: </i>{{ post.category.name }}</p>
      <ul>
        <li  class="tags" v-for="tag in post.tags" :key="tag.id"><u>
            {{ tag.name }}
          </u>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>


<style scoped lang="scss">
ul {
  list-style: none;
}

.post {
  border: 1px dashed salmon;
  padding: 1rem;
  margin: 1rem;
  background-color: beige;
  overflow: hidden;

  img {
    max-width: 100%;
  }

  h3 {
    color: red;
    padding: 10px;
  }

  .category{
    font-size: 1.25rem;
    &:hover{
      color: blue;
      scale: 2;
    }
  }

  .tags{
    color: blueviolet;
    &:hover{
      scale: 2;
      cursor: pointer;
    }
  }
}
</style>