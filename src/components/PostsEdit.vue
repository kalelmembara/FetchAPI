<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const postId = route.params.id;

const form = reactive({
    student_no: '',
    student_name: '',
    student_class: ''
})

onMounted( async () => {
    try {
        const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
        form.student_no = response.data.student_no;
        form.student_name = response.data.student_name;
        form.student_class = response.data.student_class;
    } catch (error) {
        console.log("Error fetching post", response);
    }
})

const handleSubmit = async () => {
    const updatePost = {
        student_id: postId,
        student_no: form.student_no,
        student_name: form.student_name,
        student_class: form.student_class
    }

    try {
        const response = await axios.put(`http://localhost/belajar-api/update_data.php`, updatePost);
        console.log(response);

        router.push(`/posts/${postId}`);
    } catch (error) {
        console.error("Error updating post", error);
    }
}

</script>
<template>
    <RouterLink :to="`/posts`" class="btn btn-green">Return to Posts</RouterLink>
    <div>
        <form @submit.prevent="handleSubmit">
            <label for="student_no">No</label>
            <input 
            v-model="form.student_no" 
            type="text" 
            id="student_no" 
            name="student_no" 
            placeholder="No">

            <label for="student_name">Name</label>
            <input 
            v-model="form.student_name" 
            type="text" 
            id="student_name" 
            name="student_name" 
            placeholder="Name">

            <label for="student_class">Class</label>
            <input 
            v-model="form.student_class" 
            type="text" 
            id="student_class" 
            name="student_class" 
            placeholder="Class">

            
            <button type="submit" class="btn btn-green">Submit</button>
        </form>
    </div>
</template>