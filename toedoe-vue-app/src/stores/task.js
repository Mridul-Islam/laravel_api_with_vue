import{ defineStore } from 'pinia';
import { computed, reactive, ref } from 'vue';
import { allTasks } from "../http/task-api";

const tmp = {
    state: () => ({

    }),
    getters:{
        // completedTasks: (state) => state.tasks.filter(task => task.is_completed),

        // incompletedTasks(){
        //     return this.tasks.filter(task => !task.is_completed)
        // },

        // uncompletedCount(){
        //     return this.uncompleted.length
        // }
    },
    actions: {
        // async fetchAllTasks(){
        //     const {data} = await allTasks();

        //     this.tasks = data.data;
        // }
    }
};

export const useTaskStore = defineStore('taskStore', () => {
    const tasks = ref([]);

    const incompletedTasks = computed(() => tasks.value.filter(task => !task.is_completed))
    const completedTasks = computed(() => tasks.value.filter(task => task.is_completed))

    const fetchAllTasks =  async() => {
        const {data} = await allTasks();

        tasks.value = data.data;
    }

    return {
        tasks, completedTasks, incompletedTasks, fetchAllTasks
    }
});
