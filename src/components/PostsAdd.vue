<script setup>
import axios from 'axios';
import { reactive } from 'vue';
// import router from '@/router';

const form = reactive({
    // id: '',
    student_no: '',
    student_name: '',
    student_class: ''
})
const handleSubmit = async () => {
    const newPost = {
        // id: form.id,
        student_no: form.student_no,
        student_name: form.student_name,
        student_class: form.student_class
    }
    try {
        const response = await axios.post('http://localhost/belajar-api/insert-data.php/', newPost);
        console.log(response);
        
    } catch (error) {
        console.error("Error on posting data:", error);
    }
}

</script>

<template>
    <RouterLink :to="`/posts`" class="btn btn-green">Return to Posts</RouterLink>
    <div>
        <form @submit.prevent="handleSubmit">

            <label for="no">No</label>
            <input 
            v-model="form.student_no" 
            type="text" 
            id="no" 
            name="no" 
            placeholder="No">

            <label for="name">Name</label>
            <input 
            v-model="form.student_name" 
            type="text" 
            id="name" 
            name="name" 
            placeholder="Name">

            <label for="title">Class</label>
            <input 
            v-model="form.student_class" 
            type="text" 
            id="class" 
            name="class" 
            placeholder="Class">
            
            <button type="submit" class="btn btn-green">Submit</button>
        </form>
    </div>
</template>