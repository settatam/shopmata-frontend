<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Kit Information</h1>
        </div>

        <form action="" method="post" class="px-3">
            <div class="p-4 space-y-2">
                <select
                    id="sales_method_id"
                    name="location"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="0">Choose Category</option>
                    <option
                        v-for="category in categories"
                        :key="category.index"
                        :value="category.id"
                        >{{ category.name }}</option
                    >
                </select>
            </div>

            <div class="my-2 mx-4">
                <textarea
                    class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md "
                    placeholder="Write a delivery note ......."
                    name=""
                    id=""
                    rows="10"
                    v-model="transaction.comments"
                ></textarea>
            </div>

            <!-- images start -->

            <div v-if="limitedImages" class="mx-4 my-2">
                <div class="flex justify-between flex-wrap">
                    <img
                        class="rounded-md m-2"
                        v-for="image in limitedImages"
                        :key="image.index"
                        :src="image.url"
                        alt=""
                        width="50"
                        height="40"
                    />
                </div>
            </div>

            <div v-else>
                <img
                    src="../../../../assets/placeholder.png"
                    alt=""
                    width="50"
                    height="40"
                />
            </div>

            <!-- images end -->

            <div class="">
                <div class=" grid grid-cols-3">
                    <div
                        class="flex flex-col my-2 justify-center items-center"
                        v-for="tag in top_tags"
                        :key="tag.id"
                    >
                        <label :for="tag.id" class="text-xs lg:text-sm">
                            {{ tag.name }}</label
                        >
                        <input
                            v-if="checkedList.includes(tag.id)"
                            checked
                            type="checkbox"
                            @change="saveTopTags(tag.id)"
                            :id="tag.id"
                            :value="tag.id"
                            :name="tag.name"
                        />

                        <input
                            v-else
                            type="checkbox"
                            @change="saveTopTags(tag.id)"
                            :id="tag.id"
                            :value="tag.id"
                            :name="tag.name"
                        />
                    </div>
                </div>
            </div>
        </form>

        <!-- sms start -->
        <div>
            <Sms :transaction="transaction.sms" :id="transaction.id" class="my-4" />
        </div>
    </div>
</template>

<script>
import { computed, reactive, ref } from '@vue/runtime-core'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Sms from '../Components/Sms.vue'
import { notify } from 'notiwind'

export default {
    components: { AppLayout, Sms },
    props: ['categories', 'transaction', 'top_tags'],
    setup (props) {
        const successMessage = ref('')
        const transaction_id = props.transaction.id
        // const filteredCategory = computed(() => {
        //     return categories.filter(item => {
        //         return item.slug
        //     })
        // })
        const images = props.transaction.images

        const limitedImages = computed(() => {
            let filteredimage = []
            for (let i = 0; i < 5; i++) {
                if (images[i] == undefined) {
                    break
                }
                filteredimage.push(images[i])
            }
            return filteredimage
        })
        const pickedTags = props.transaction.tags
        const checkedList = computed(() => {
            let myArray = []
            pickedTags.forEach(item => {
                return myArray.push(item.tag_id)
            })
            return myArray
        })

        function onClickTop () {
            notify(
                {
                    group: 'top',
                    title: 'Success',
                    text: successMessage.value
                },
                4000
            )
        }
        function onClickBot () {
            notify(
                {
                    group: 'bottom',
                    title: 'Error',
                    text: successMessage.value
                },
                4000
            )
        }

        function saveTopTags (tag_id) {
            if (this.checkedList.includes(tag_id)) {
                axios
                    .post(`/admin/tag + ${transaction_id}`, { tag_id })
                    .then(res => {
                        if (res.status == 200) {
                            successMessage.value = 'Tag removed'
                            setTimeout(onClickTop, 2000)
                        } else if (res.status == 422) {
                            successMessage.value = res.data.notification.message
                            setTimeout(onClickBot, 2000)
                            setTimeout(errorFn, 3000)
                        }
                    })
                    .catch(error => {
                        successMessage.value = 'Error processing your request'
                        setTimeout(onClickBot, 2000)
                        setTimeout(errorFn, 3000)
                    })
            } else {
                axios
                    .post('/transaction/tag', { tag_id, transaction_id })
                    .then(res => {
                        if (res.status == 200) {
                            successMessage.value = 'Tag added'
                            setTimeout(onClickTop, 2000)
                        } else if (res.status == 422) {
                            successMessage.value = res.data.notification.message
                            setTimeout(onClickBot, 2000)
                            setTimeout(errorFn, 3000)
                        }
                    })
                    .catch(error => {
                        successMessage.value = 'Error processing your request'
                        setTimeout(onClickBot, 2000)
                        setTimeout(errorFn, 3000)
                    })
            }
        }

        return {
            images,
            limitedImages,
            saveTopTags,
            onClickTop,
            onClickBot,
            checkedList
        }
    }
}
</script>
