<template>
    <div class="addItem">
        <input type="text" placeholder="New task" v-model="item.name"/>
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class="[ item.name ? 'active' : 'inactive', 'plus']"
        />
    </div>
</template>

<script>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

export default {
    components: {FontAwesomeIcon},
    data: function () {
        return {
            item: {
                name: ""
            }
        }
    },
    methods: {
        addItem() {
            if (this.item.name == "") {
                return;
            }
            axios.post('api/item/store', {
                item: this.item
            })
                .then(response => {
                    if (response.status == 201) {
                        this.item.name = '';
                        this.$emit("reloadlist");
                    }
                })
                .catch(error => {
                    console.log('error');
                })
        }
    }

}
</script>

<style scoped>
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}

input {
    border: 0px;
    background: #f7f7f7;
    outline: none;
    padding: 5px;
    margin-right: 5px;
    width: 100%;
}

.plus {
    font-size: 20px;
}

.active {
    color: #00CE25;
}

.inactive {
    color: #999999;
}
</style>
