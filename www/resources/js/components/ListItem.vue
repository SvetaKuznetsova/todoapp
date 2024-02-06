<template>
    <div class="item">
        <div v-if="item">
            <input
                type="checkbox"
                @change="updateCheck()"
                v-model="item.is_completed"
                :true-value="1"
                :false-value="0"
            />
            <span :class="[item.is_completed ? 'completed' : '', 'itemText']" v-show="!showField('item.name')"
                  @click="focusField('item.name')">{{ item.name }}</span>
            <input v-model="item.name"
                   v-show="showField('item.name')"
                   id="item-name"
                   type="text"
                   class="field-value form-control"
                   @focus="focusField('item.name')"
                   @blur="blurField"
                   @change="updateItemName()"
            >
            <button @click="removeItem()" class="trashcan">
                <font-awesome-icon icon="trash"/>
            </button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['item'],
    data() {
        return {
            editField: ''
        }
    },
    components: {

    },

    methods: {
        updateCheck() {
            axios
                .put('api/item/' + this.item.id, {
                    item: this.item
                })
                .then(response => {
                    if (response.status == 200) {
                         this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error update comleted status", error);
                });
        },
        removeItem() {
            axios
                .delete('api/item/' + this.item.id)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error delete ", error);
                });
        },
        focusField(name) {
            this.editField = name;
        },
        blurField() {
            this.editField = '';
        },
        showField(name) {
            return (this.item.name == '' || this.editField == name)
        },
        updateItemName() {
            axios
                .put('api/item/' + this.item.id, {
                    item: this.item
                })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error update item name", error);
                });
        },
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}

.itemText {
    width: 100%;
    margin-left: 20px;
}

.item {
    display: flex;
    justify-content: left;
    align-items: center;
}

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #FF0000;
    outline: none;
    margin-right: 20px;
    margin-left: 20px;
}
</style>
