<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="todo-list-container">
                    <div class="heading">
                        <h2>TooDo List</h2>
                        <add-item-form
                            v-on:reloadlist="getList()" />
                    </div>

                 <list-view :items="items"
                    v-on:reloadlist="getList()"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import addItemForm from "./AddItemForm.vue"
import listView from "./ListView.vue";


export default {
    components: {
        addItemForm,
        listView,
    },
    data: function () {
        return {
            items: []
        }
    },
    methods: {
        getList: function () {
            axios.get('api/items')
                .then(response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateItems(newItems) {
                this.items = newItems;
            }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todo-list-container {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
