<template>
    <div class="task-actions">
        <button class="btn btn-sm btn-circle btn-outline-secondary me-1" @click="emit('edit')">
            <iconPencil />
        </button>
        <button class="btn btn-sm btn-circle btn-outline-danger" @click="emit('remove')">
            <IconTrash />
        </button>
    </div>
</template>


<script setup>

import IconPencil from "../icons/iconPencil.vue";
import IconTrash from "../icons/iconTrash.vue";

const emit = defineEmits(['edit', 'remove']);

</script>
