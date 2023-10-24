<template>

    <main style="min-height: 50vh; margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Add new Task -->
                    <newTask @added="handleAddedTask" />

                    <!-- List of Incompleted tasks -->
                    <Tasks
                        :tasks="incompletedTasks"
                        @updated="handelUpdateTask"
                        @completed="handleCompletedTask"
                        @removed="handleRemovedTask"
                    />

                    <!-- Show Toggle Button -->
                    <div class="text-center my-3" v-show="showToggleCompletedBtn">
                        <button class="btn btn-sm btn-secondary" @click="showCompletedTasks = !showCompletedTasks">
                        <span v-if="!showCompletedTasks">Show completed</span>
                        <span v-else>Hide Completed</span>
                        </button>
                    </div>

                    <!-- List of Completed tasks -->
                    <Tasks
                        :tasks="completedTasks"
                        :show="completedTasksIsVisible && showCompletedTasks"
                        @updated="handelUpdateTask"
                        @completed="handleCompletedTask"
                        @removed="handleRemovedTask"
                    />

                </div>
            </div>
        </div>
    </main>

</template>



<script setup>

    import {computed, onMounted, ref} from "vue";
    import {allTasks, createTask, updateTask, completeTask, removeTask } from '../http/task-api';
    import Tasks from "../components/tasks/Tasks.vue";
    import newTask from "../components/tasks/NewTask.vue"
    import { useTaskStore } from "../stores/task";
    import { storeToRefs } from "pinia";

    const store = useTaskStore();

    const {completedTasks, incompletedTasks} = storeToRefs(store);

    // store.$patch({
    //     task:{
    //         name: "First Task updated using $patch",
    //         is_completed: true
    //     }
    // })

    const tasks = ref([]);

    onMounted(async() => {

        await store.fetchAllTasks();

    })


    const showToggleCompletedBtn = computed(
        () => incompletedTasks.value.length > 0 && completedTasks.value.length > 0
    )

    const completedTasksIsVisible = computed(
        () => incompletedTasks.value.length === 0 || completedTasks.value.length > 0
    )

    const showCompletedTasks = ref(false)

    // Create New Task
    const handleAddedTask = async(newTask) => {
        const { data: createdTask } = await createTask(newTask)
        tasks.value.unshift(createdTask.data)
    }

    // Update a Task
    const handelUpdateTask = async(task) => {
        const { data: updatedTask } =  await updateTask(task.id, {
            name: task.name
        })

        const currentTask = tasks.value.find(item => item.id === task.id);
        currentTask.name = updatedTask.data.name;
    }

    // Change Task Status
    const handleCompletedTask = async(task) => {
        const { data: updatedTask } = await completeTask(task.id, {
            is_completed: task.is_completed
        })

        const currentTask = tasks.value.find(item => item.id === task.id)
        currentTask.is_completed = updatedTask.data.is_completed
    }

    const handleRemovedTask = async (task) => {
        await removeTask(task.id)
        const index = tasks.value.findIndex(item => item.id === task.id)
        tasks.value.splice(index, 1)
    }


</script>
