<template>
  <!-- Main -->
  <main class="main grid">
    <transition name="fade">
      <div class="loader" v-show="show">
        <div class="loading"></div>
      </div> 
    </transition>
    <div class="categories-tags">
      <categories :categories="categories"></categories>
      <tags :tags="tags"></tags>
    </div>
    <posts :posts="posts" v-if="!show"></posts>
    <p v-else>No se encontraron posts</p>
  </main>
  <!-- End main -->
</template>

<script>
import posts from '../posts/PostList'
import categories from '../categories/CategoryList'
import tags from '../tags/TagsList'
export default {
    components:{
      posts,
      categories,
      tags
    },
    data(){
      return{
        posts:'',
        categories:'',
        tags:'',
        show:true
      }
    },
    created(){
      this.getPosts()
      this.getCategories()
      this.getTags()
    },
    methods:{
      getPosts(){
        axios.get("/api/posts").then((response) => {
        this.posts=response.data;
        this.show=false;
        }).catch(error=>{
          this.show=true;
        })
      },
      getCategories(){
        axios.get('/api/categories').then(response=>{
        this.categories=response.data;
        this.show=false;
        }).catch(error=>{
          this.show=true;
        })
      },
      getTags(){
        axios.get('/api/tags').then(response=>{
        this.tags=response.data;
        this.show=false;
        }).catch(error=>{
          this.show=true;
        })
      }
    }
}
</script>