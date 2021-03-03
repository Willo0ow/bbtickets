
export default {
    methods:{
        allowDrop(event) {
            event.preventDefault();
        },
        drag(event, task, index, currentStatus) {
            event.dataTransfer.setData("text", event.target.id);
            this.draggedTask = task
            this.draggedTaskIndex = index
            this.draggedTaskCurrentStatus = currentStatus
        },
        drop(event) {
            event.preventDefault();
            const data = event.dataTransfer.getData("text");
            const closestStatus = event.target.closest('.status-body')
            const status = closestStatus.id
            this.draggedTask.status = status
            this.tasksByStatus[this.draggedTaskCurrentStatus].splice(this.draggedTaskIndex, 1)
            this.tasksByStatus[status].push(this.draggedTask)
            this.draggedTask = null
            this.draggedTaskIndex = null
            this.draggedTaskCurrentStatus = null
        }
    }
}