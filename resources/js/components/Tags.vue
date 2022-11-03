<template>
    <ul>
      <li v-for="tag in tags" :key="tag.id">{{ tag.name }}</li>
    </ul>
  </template>
  
  <script>
    export default {
      props: {
        tags: {
          type: Array,
          required: true
        }
      }
    }
  </script>
  
  <style lang="scss" scoped>
  </style>