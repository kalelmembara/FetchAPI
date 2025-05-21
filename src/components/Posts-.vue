<script setup>
import { onMounted, reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import axios from 'axios';
import Post from '@/components/Post-.vue';

const router = useRouter();

const state = reactive({
    posts: []
})

const handleLogout = () => {
    if (confirm('Apakah Anda yakin ingin logout?')) {
        // Clear login state
        localStorage.removeItem('isLoggedIn');
        // Redirect to home page
        router.push('/');
    }
};

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/belajar-api/get-all-data.php');
    state.posts = response.data;
  } catch (error) {
    console.error('Error fetching jobs:', error);
  }
});
</script>
<template>
  <div class="center-container">
    <h1>Semua Post</h1> 
    <button @click="handleLogout" class="btn btn-blue">Logout</button><br>
    <RouterLink :to="`/posts/add`" class="btn btn-green">Tambah</RouterLink>
    <br />
    <br />
    <table id="posts" border="1">
      <thead>
        <tr>
            <th>NO</th>
            <th>Name</th>
            <th>Class</th>
            <th>Aksi</th>
        </tr>
      </thead>
        <tbody>
          <Post v-for="post in state.posts" :key="post.id" :post="post"/>
        </tbody>
        
    </table>
  </div>
</template>

<style scoped>
.center-container {
  padding: 20px;
  color: white;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th, td, tr {
  padding: 8px;
  text-align: left;
  color: white;
  align-items: center;
  text-align: center;
}
</style>