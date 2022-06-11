<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <ImageSlider :images="images" :open="openModal" @close="doClose">
        </ImageSlider>


        <div class="text-xl px-4 rounded-t-md w-full font-bold flex justify-center text-black">
            <h1>SMS</h1>
        </div>

        <!-- sms chatbox starts -->
        <div>
            <div v-if="trSmses.length > 0" class="px-3 space-y-2 h-48 overflow-y-auto">
                <template class="bg-gray-lightest p-4 " v-for="(sms, index) in trSmses.slice().reverse()"
                    :key="sms.index">
                    <div class="flex items-end justify-end" v-if="sms.is_coming">
                        <div class="flex flex-col w-1/2 max-w-xs mx-2 order-1 items-end">
                            <div class="px-4 py-2 rounded-lg inline-block p-2 bg-blue-600 text-white ">
                                <p class="text-xs py-2">
                                    {{ formattedTimes[index] }}
                                </p>
                                <span>{{ sms.message }}</span>
                                 <div
                                    class=""
                                    v-if="sms.images.length"
                                    
                                >
                                    <a
                                        class="h-24 w-24 flex-shrink-0 cursor-pointer"
                                        @click="doSlider(sms.images)"
                                    >
                                        <img
                                            class="max-w-full h-24"
                                            :src="sms.images[0].url"
                                            alt=""
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="bg-gray-300  mx-4 my-2 w-3/4 p-2 rounded-lg flex flex-col justify-start">
                        <p class="text-xs py-2">{{ formattedTimes[index] }}</p>
                        <p>{{ sms.message }}</p>
                    </div>
                </template>
            </div>

            <div v-else class="bg-gray-lightest py-4">
                <p class="text-center">No messages</p>
            </div>

            <div class="mt-3 mx-1">
                <div class="flex justify-center">
                    <h1 class="text-black font-bold text-xl pt-4">Send SMS</h1>
                </div>

                <form action="#" class="relative">
                    <div
                        class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                        <!-- <label for="title" class="sr-only">Title</label>
                        <input type="text" name="title" id="title"
                            class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0"
                            placeholder="Title" /> -->
                        <label for="description" class="sr-only">Description</label>
                        <textarea rows="2" name="description" id="description"
                            class="block w-full border-0 py-2 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm"
                            v-model="smsMessage" placeholder="Write a description..." />

                        <!-- Spacer element to match the height of the toolbar -->
                        <div aria-hidden="true">
                            <div class="py-2">
                                <div class="h-9" />
                            </div>
                            <div class="h-px" />
                            <div class="py-2">
                                <div class="py-px">
                                    <div class="h-9" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-0 inset-x-px">
                        <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->
                        <div class="flex flexwrap justify-end py-2 px-2 space-x-2 sm:px-3">



                        </div>
                        <div
                            class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                            <div class="flex">
                                <!-- <button class="-ml-2 -my-2 rounded-full px-3 py-2 inline-flex items-center text-left text-gray-400 group"> -->
                                <label class="hover:scale-110 cursor-pointer pl-3" for="file">
                                    <PaperClipIcon class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"
                                        aria-hidden="true" />
                                    <!-- </button> -->
                                    <input @change="previewImages($event)" type="file" class="hidden " id="file"
                                        name="image" accept="image/gif,image/jpeg,image/jpg,image/png" multiple=""
                                        data-original-title="upload photos">
                                </label>
                            </div>

                            <!-- <div class="flex-shrink-0">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">send
                                    Message</button>
                            </div> -->
                        </div>
                    </div>
                </form>

                <images-list class="mx-3" :images="images" v-if="images.length" @image-deleted="delete_img" />
            </div>


            <div class="flex justify-center">
                <Button class="my-6" @sendResponse="addMessage" :loadingAnimation="loadingAnimation"
                    :buttonName="buttonName" />
            </div>
        </div>
    </div>
</template>

<script>
import { computed, watch } from '@vue/runtime-core'
import axios from 'axios'
import AppLayout from '../../../Layouts/AppLayout.vue'
import { ref, reactive } from 'vue'
import Button from '../../../Components/Button.vue'
import ImageSlider from "../../Widgets/ImageSlider";

import ImagesList from '../../../Components/ImageList.vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CalendarIcon, PaperClipIcon, TagIcon, UserCircleIcon } from '@heroicons/vue/solid'
import fileUploader from "../../../Utils/fileUploader";
import urls from '../../../api/urls'
import { notify } from "notiwind";
import notification from "../../../Utils/notification";

export default {
    components: { AppLayout, Button, Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions, ImageSlider, CalendarIcon, PaperClipIcon, TagIcon, UserCircleIcon, ImagesList },
    props: ['smses', 'id'],
    setup(props) {
        let smsMessage = ref('');
        const buttonName = ref('Send Message')
        const loadingAnimation = ref(false)
        const url = "/admin/images";
        const openModal = ref(false);
        const images = ref([]);
        const trSmses = ref(props.smses)
        const { saveFiles }   = fileUploader();
        const largeImagesUrls = ref([])
        const { notifyAlert } = notification();

        function previewImages(event) {
            let acceptFiles = event.target.files
            saveFiles(Array.from(acceptFiles))
                .then((res) => {
                    images.value = res.data
                }).then(() => {
                    largeImagesUrls.value = []
                    images.value.filter((image) => {
                        largeImagesUrls.value.push(image.large)
                    })
                })
                .catch((err) => console.log(err))
        }


        function delete_img(index) {
            images.value.splice(index)
        }


        const doSlider = (i) => {
            images.value = i;
            openModal.value = true;
        };

        // test


        function formatDate(date) {
            var hours = date.getHours()
            var minutes = date.getMinutes()
            var ampm = hours >= 12 ? 'pm' : 'am'
            hours = hours % 12
            hours = hours ? hours : 12 // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes
            var strTime = hours + ':' + minutes + ' ' + ampm
            return date.getMonth() + 1 + '/' + date.getDate() + '  ' + strTime
        }

        function addMessage() {
            loadingAnimation.value = true
            axios.post(urls.transactions.sms(props.id), {
                message: smsMessage.value, images: largeImagesUrls.value
            }).then((res) => {
                loadingAnimation.value = false
                smsMessage.value = ""
                images.value = []
                trSmses.value = res.data.sms
                setTimeout(
                    notifyAlert(
                        "SMS sent successfully",
                        "top",
                        "Success"
                    ),
                    2000
                );
            }).catch(err => {
                loadingAnimation.value = false
                setTimeout(
                    notifyAlert(
                        "Error processing your request",
                        "bottom",
                        "Error"
                    ),
                    2000);
    })

        }

        const formattedTimes = computed(() => {
            return trSmses.value.map(item => {
                let d = new Date(Date.parse(item.created_at))
                return formatDate(d)
            })
        })

        return { doSlider, openModal, trSmses, formatDate, formattedTimes, smsMessage, addMessage, buttonName, loadingAnimation, url, images, previewImages, delete_img, largeImagesUrls }
    }
}
</script>
