<script setup>
import { RouterLink } from 'vue-router';
</script>
<template>
    <div class="center-container">
        <h1>Welcome kkalee.</h1>
        <RouterLink :to="`/login`" class="btn btn-green">Login</RouterLink>
    </div>
</template>