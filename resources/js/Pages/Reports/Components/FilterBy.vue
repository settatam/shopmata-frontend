<template>
    <div class=" my-3 md:px-0 rounded">
        <div class="pt-3 ">
            <h2 class="text-xs font-bold  text-purple-darken">FILTER BY:</h2>
        </div>

        <div class="flex flex-wrap">
            <div
                class="my-2 border bg-white"
                v-for="(item, mainIndex) in filterLists"
                :key="mainIndex"
            >
                <div class="">
                    <div
                        class="bg-purple-darken text-white font-bold px-2 py-2"
                    >
                        <h1>{{ item.label }}</h1>
                    </div>
                    <div class="pl-3 py-3 bg-white h-96 overflow-scroll overflow-x-auto overflow-y-auto">
                        <div>
                            <div
                                v-for="(filter, filterIndex) in item.fields.options"
                                :key="filter.filterIndex"
                                class="space-x-2 px-2"

                            >
                                <input
                                    type="checkbox"
                                    :id="'id-' + filterIndex + mainIndex"
                                    :name="item.fields.name"
                                    :value="filter.value"
                                    v-model="item.fields.selected"
                                    @change="doChange(mainIndex)"
                                />
                                <label :for="'id-' + filterIndex + mainIndex" class="text-xs lg:text-xs">
                                    {{ filter.label }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, watch, ref } from "vue";
export default {
    props: {
        notifications: Array,
        formObject: Object,
        filters: Object
    },
    setup (props, {emit}) {
        const filterLists = ref(props.formObject)

        function doChange(event) {
            emit('filter-changed', filterLists);
        }

        watch(() => props.formObject, (first, second) => {
            filterLists.value = first;
            console.log('filter lists assinged', filterLists.value)
        })

        return {
            filterLists,
            doChange
        }
    }
}
</script>

<style scoped>
/* .myGrid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
} */
</style>
