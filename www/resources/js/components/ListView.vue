<template>
    <div>
        <draggable :list="items" @change="saveReorder" >
            <template #item="{element}">

                <list-item
                    :item="element"
                    class="item"
                    v-on:itemchanged="$emit('reloadlist')"
                />

            </template>
        </draggable>
    </div>

</template>

<script>
import listItem from "./ListItem.vue"
import draggable from 'vuedraggable'


export default {
    props: ['items'],
    components: {
        listItem,
        draggable
    },

    methods: {
        saveReorder(event) {
            console.log(event)

           this.reorder()
            this.items.forEach((item) =>
                axios
                    .put('api/item/' + item.id, {
                        item: item
                    })
                    .then(response => {
                        if (response.status == 200) {
                            this.$emit("itemchanged");
                        }
                    })
                    .catch(error => {
                        console.log("error update item order", error);
                    })
            )
        },
        reorder() {
            this.items.forEach((item, index) => (item.sort = index+1))
        },
    },
}
</script>


<style scoped>
.item {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;

}
</style>
