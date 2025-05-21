<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const form = reactive({
    username: '',
    password: ''
});

const handleLogin = async () => {
    try {
        // Log the request data
        console.log('Sending login request with:', {
            username: form.username,
            password: form.password
        });

        // Set headers for the request
        const config = {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        };

        const response = await axios.post('http://localhost/belajar-api/login.php', {
            username: form.username,
            password: form.password
        }, config);

        // Log the complete response
        console.log('Full API Response:', response);
        console.log('Response Data:', response.data);
        console.log('Response Status:', response.status);
        console.log('Response Headers:', response.headers);

        // Check if response.data exists
        if (!response.data) {
            throw new Error('No data received from server');
        }

        // Check the response format
        if (response.data.status === 'success') {
            console.log('Login successful, redirecting to posts page');
            // Store login state
            localStorage.setItem('isLoggedIn', 'true');
            // Redirect to posts page
            router.push('/posts');
        } else {
            console.error('Login failed. Response:', response.data);
            alert(response.data.message || 'Invalid credentials');
        }
    } catch (error) {
        console.error('Login error details:', {
            message: error.message,
            response: error.response?.data,
            status: error.response?.status,
            headers: error.response?.headers
        });
        
        if (error.response) {
            // The request was made and the server responded with a status code
            console.error('Error response data:', error.response.data);
            alert(error.response.data.message || 'Server error occurred');
        } else if (error.request) {
            // The request was made but no response was received
            console.error('No response received:', error.request);
            alert('No response from server. Please check your connection.');
        } else {
            // Something happened in setting up the request that triggered an Error
            console.error('Error setting up request:', error.message);
            alert('Error: ' + error.message);
        }
    }
};
</script>

<template>
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="main-title">Login</h1>
            <div class="form-container">
                <form @submit.prevent="handleLogin">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input 
                            v-model="form.username" 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Enter your username"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            v-model="form.password" 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required>
                    </div>

                    <div class="buttons-container">
                        <RouterLink to="/" class="btn btn-primary">
                            <span class="btn-icon">←</span>
                            <span class="btn-text">Back</span>
                        </RouterLink>
                        <button type="submit" class="btn btn-success">
                            <span class="btn-icon">→</span>
                            <span class="btn-text">Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
        <div class="decoration-circle circle-3"></div>
    </div>
</template>

