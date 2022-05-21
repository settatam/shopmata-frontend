<template>
  <div>
       <ImageSlider
            :images="images"
            :open="openModal"
            @close="doClose"
        >
        </ImageSlider>
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">{{ title }}</h1>
        <p class="mt-2 text-sm text-gray-700">{{ description }}</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            v-if="exportable"
                @click="exportData()"
        >
            Export
        </button>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5">
              <div class="shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600" v-if="isSearchable">
                <input type="search" name="filter" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm px-3 py-3" :placeholder="filterText" />
              </div>
              <div v-if="selectedItems.length && actions.length" class="px-3 py-3 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16">
                  <form v-for="(action, index) in actions" class="flex mr-2">
                      <div v-for="(formGroup, formIndex) in action.formGroups">
                          <label v-if="formGroup.label"> {{ formGroup.label }}</label>
                          <select
                              v-model="formGroup.field.attributes.value"
                              :name="formGroup.field.attributes.name"
                              class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md mr-2">
                              <option v-for="option in formGroup.field.options" :value="option.value">
                                  {{ option.text }}
                              </option>
                          </select>
                      </div>
                      <button type="button"
                              @click="doAction(index, 0)"
                                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                              {{ action.buttons[0].label }}
                      </button>
                  </form>
                  <p class="text-gray-500 text-xs"> {{ selectedItems.length }} Items selected </p>
              </div>
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                  <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8" v-if="hasCheckBox">
                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :checked="indeterminate || selectedItems.length === items.length" :indeterminate="indeterminate" @change="selectedItems = $event.target.checked ? items.map((i) => i.id) : []" />
                        </th>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900"
                              v-for="(field, index) in fields"
                              :key = index
                          > {{ field[1] }}
                        </th>

                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="(item, index) in items"
                        :key="index"
                    >
                        <td class="relative w-12 px-6 sm:w-16 sm:px-8" v-if="hasCheckBox">
                            <div v-if="selectedItems.includes(item.id)" class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :value="item.id" v-model="selectedItems" />
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500"
                            v-for="(tranItem, tranIndex) in item"
                        >
                            <div class="flex items-center" v-if="item[tranIndex].type == 'customer_info'">
                                  <div class="ml-4">
                                    <div class="font-medium text-gray-900">
                                        <inertia-link :href="item[tranIndex].href">
                                            {{ item.customer_info.data.first_name }} {{ item.customer_info.data.last_name }}
                                        </inertia-link>
                                    </div>
                                    <div class="text-gray-500">{{ item.customer_info.data.email }}</div>
                                  </div>
                            </div>
                            <div class="flex items-center" v-else-if="item[tranIndex].type == 'slideshow'">
                                <a class="h-10 w-10 flex-shrink-0 cursor-pointer" v-if="item.pictures.data.length" @click="doSlider(item.pictures.data)">
                                    <img class="h-10 w-10" :src="item.pictures.data[0].url" alt="" />
                                </a>
                            </div>
                            <div class="flex items-center" v-else-if="item[tranIndex].type == 'link'">
                                <inertia-link :href="item[tranIndex].href"> {{ item[tranIndex].data }}  </inertia-link>
                            </div>

                            <div class="flex items-center max-w-xs flex-wrap" v-else>
                                {{ item[tranIndex].data }}
                            </div>

                        </td>
                    </tr>
                  </tbody>
                </table>

              <div class="px-3">
                  <Pagination :meta="pagination" ></Pagination>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
    import {onMounted, ref, computed} from 'vue'
    import axios from 'axios'
    import Pagination from "../../Components/Pagination";
    import { Inertia } from '@inertiajs/inertia'
    import ImageSlider from './ImageSlider';

    const props = defineProps({
        filters: Object
    })

    const emits = defineEmits([
        'action'
    ]);

import {
        BadgeCheckIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        CollectionIcon,
        SearchIcon,
        SortAscendingIcon,
        StarIcon,
        ShoppingBagIcon
    } from '@heroicons/vue/solid'

    import { ScaleIcon } from '@heroicons/vue/outline'


    const transactions = ref([]);
    const title = ref('');
    const description = ref('');
    let fields = ref([]);
    let items = ref([]);
    const actions = ref([]);
    const checked = ref(false)
    const selectedItems = ref([])
    const hasCheckBox = ref(false);
    const indeterminate = computed(() => selectedItems.value.length > 0 && selectedItems.value.length < items.length)
    const filterText = ref('Search Table');
    const bulkAction = ref('');
    const exportable = ref(false)
    const isSearchable = ref(false)
    const pagination = ref({})
    const openModal = ref(false)
    const images = ref([]);

    const filters = props.filters;

    onMounted(() => {
        getData();
    })

    const bulkActions = (el) => {

    }

    function doAction(index, formGroupIndex) {
        //we should emit actions here ...
        emits('action', actions.value[formGroupIndex], selectedItems.value);
    }


    const getFieldIndex = (field, obj) =>  {
        return obj.findIndex(e => e.key === field);
    }

    const getData = () => {
        axios.get('/admin/widgets/view', {
            params: filters
        }).then((res) => {
            fields.value = res.data.fields
            items.value = res.data.data.items;
            actions.value = res.data.actions;
            hasCheckBox.value = res.data.hasCheckBox;
            title.value = res.data.title
            // description.value = res.data.description.value
            exportable.value = res.data.exportable;
            isSearchable.value = res.data.isSearchable;
            pagination.value = res.data.pagination
        })
    }

    const doClose = () => {
        openModal.value = false;
    }

    const doSlider = (i) => {
        images.value = i
        openModal.value = true;

    }

    const open = ref(false);

</script>
