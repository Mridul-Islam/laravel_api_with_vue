import{ defineStore } from 'pinia';
import { allTasks } from "../http/task-api";

export const useTaskStore = defineStore('taskStore', {
    state: () => ({
        tasks: [],
        task: {
            id: 1,
            name: "First task",
            is_completed: false
        }
    }),
    getters:{
        completedTasks: (state) => state.tasks.filter(task => task.is_completed),

        incompletedTasks(){
            return this.tasks.filter(task => !task.is_completed)
        },

        uncompletedCount(){
            return this.uncompleted.length
        }
    },
    actions: {
        async fetchAllTasks(){
            const {data} = await allTasks();

            this.tasks = data.data;
        }
    }
});
