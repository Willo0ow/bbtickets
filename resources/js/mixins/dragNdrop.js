import axios from '../axios'
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
        async assignNewStatus({status, ticketId}){
            const form = {status}
            const tlog = {ticket: ticketId, variable: 'status', value: status, correction: true}
            await axios.patch(`/ticket/${ticketId}`, {ticket: form, tlog:tlog})
        },
        async drop(event) {
            event.preventDefault();
            const data = event.dataTransfer.getData("text");
            const closestStatus = event.target.closest('.status-body')
            const status = closestStatus.id
            this.draggedTask.status = status
            this.tasksByStatus[this.draggedTaskCurrentStatus].splice(this.draggedTaskIndex, 1)
            this.tasksByStatus[status].push(this.draggedTask)
            await this.assignNewStatus({status, ticketId: this.draggedTask.id})

            this.draggedTask = null
            this.draggedTaskIndex = null
            this.draggedTaskCurrentStatus = null
        }
    }
}