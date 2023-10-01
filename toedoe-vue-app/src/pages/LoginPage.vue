<template>
<div class="text-center my-5 mx-5 py-5" >

    <h1>LogIn</h1>

    <button class="btn btn-primary" @click="handleClick">LogIn</button>
</div>
</template>


<script setup>
import { useRouter } from "vue-router"

const router = useRouter()

const handleClick = () => {
    router.push({ name: 'tasks' })
}


</script>
