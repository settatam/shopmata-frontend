<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto"
            @close="closeModal"
        >
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-96 text-center sm:block sm:p-0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6 my-0"
                    >
                        <div class="flex justify-end pb-4">
                            <x-icon
                                class="h-6 w-6 cursor-pointer text-right border-black border-2"
                                style="border-radius: 50%"
                                @click="closeModal"
                            />
                        </div>
                        <div>
                            {{ }}
                        </div>
                        <div class="w-full" v-if="images.length">
                            <div class="flex justify-center align-middle h-96 relative mx-5 flex-col">
                                <chevron-left-icon class="prev absolute top-1/2 left-0 cursor-pointer h-10" @click="prev"></chevron-left-icon>
                                <chevron-right-icon class="next absolute top-1/2 right-0 cursor-pointer h-10" @click="next"> Next </chevron-right-icon>
                                <img :src="images[index].url" class="max-w-full h-96"/>
                                <p> {{ index+1 }} of {{ images.length }}</p>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
    import {ref} from 'vue';
    import {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
    } from "@headlessui/vue";
    import { XIcon } from "@heroicons/vue/solid";
    import {
        ChevronLeftIcon,
        ChevronRightIcon
    } from '@heroicons/vue/outline'

    const index = ref(0);
    const props = defineProps({
        images: Array,
        open: Boolean
    })

    const emits = defineEmits(['close'])
    const next = () => {
        index.value == props.images.length-1 ? 0 : index.value++;
    }

    const prev = () => {
        index.value > 0 ? index.value-- : 0;
    }

    const closeModal = () => {
        // props.open = false;
        index.value = 0;
        emits("close");
    };

</script>
