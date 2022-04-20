<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="image in imagesList"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
        >
            <div class="w-3/10 py-3">
                <img class="h-10 w-10" :src="image.thumb" alt="" />
            </div>
            <div class="flex-grow w-5/10">
                <div class="border-r border-l px-6 py-3 border-gray-300">
                    <input
                        type="text"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-2"
                        placeholder="Write a description"
                        v-model="image.alt"
                    />
                </div>
            </div>
            <div class="flex items-center px-2 py-3 justify-around w-2/10">
                <input
                    type="radio"
                    v-model="image.is_default"
                    name="image"
                    id=""
                    class="w-5 h-5"
                    value="true"
                />
                <TrashIcon
                    class="w-6 h-6 text-gray-500"
                    @click="delete_image(image.id)"
                />
            </div>
        </li>
    </ul>
</template>

<script>
import { TrashIcon } from "@heroicons/vue/outline";
import { ref } from "vue";
export default {
    components: {
        TrashIcon,
    },
    props: {
        images: Array,
    },
    emits: ["delete_img"],
    setup({ images }, { emit }) {
        const imagesList = ref(images);
        const list = ref([]);
        const delete_image = (num) => {
            list.value = imagesList.value.filter((img) => num !== img.id);
            imagesList.value = list.value;
            emit("delete_img", imagesList.value);
        };
        return {
            imagesList,
            delete_image,
            list,
        };
    },
};
</script>
