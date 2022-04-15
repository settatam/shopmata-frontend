<template>
    <div class=" rounded-md mt-18 bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1 class="text-white">Transaction Timeline</h1>
        </div>

        <div
            class="flex flex-col md:flex-col lg:flex-row lg:space-x-2 justify-between px-8"
        >
            <div class=" my-4 flex flex-row sm" id="statusgroup">
                <label class="pt-2" for="">Status: </label>
                <div
                    class="flex flex-col md:flex lg:flex-row sm:space-x-0 lg:space-x-12 space-y-3 lg:space-y-0"
                >
                    <div>
                        <select
                            class="py-3 text-sm text-black rounded-md focus:outline-none focus:bg-white mx-8 w-full"
                            name=""
                            id=""
                        >
                            <option
                                v-for="status in statuses"
                                :key="status.index"
                                value=""
                                >{{ status.name }}</option
                            >
                        </select>
                    </div>
                    <div class="ml-6">
                        <button
                            class="bg-purple-darken py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken mx-2 md:ml-8 lg:mx-0 px-2"
                            type="submit"
                        >
                            Confirm Status
                        </button>
                    </div>
                </div>
            </div>

            <div class=" my-4 flex flex-row" id="offergroup">
                <label class="pt-2" for="">Offer: </label>
                <div class="flex flex-col lg:flex-row space-x-8 lg:space-x-6">
                    <div class="flex flex-col lg:ml-0 ml-8">
                        <input
                            type="search"
                            class="py-3 text-sm text-black rounded-md focus:outline-none focus:bg-white mx-2 sm:w-1/3 md:w-full lg:w-full"
                            placeholder="Kit Received"
                            autocomplete="off"
                        />
                        <div class="flex flex-row ml-1">
                            <input
                                type="checkbox"
                                class="text-xs my-2 mx-2"
                                name="2ndoffer"
                                id="2ndoffer"
                            />
                            <label class="mt-1" for="2ndoffer">2nd Offer</label>
                        </div>
                    </div>
                    <div class="">
                        <button
                            class="bg-purple-darken py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken mx-2 lg:mx-0 px-2"
                            type="submit"
                        >
                            Send Offer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col lg:flex-row text-black text-xs pl-4 md:text-sm"
        >
            <div class="flex flex-col p-4 space-y-3 lg:w-1/3">
                <p class="text-green-darker">Kit requested</p>
                <p class="text-green-darker">Kit sent</p>
                <p class="text-green-darker">Package Received</p>
                <p>Offer given</p>
                <p>Offer accepted</p>
                <p>Payment processed</p>
            </div>

            <div class="flex flex-col lg:w-2/3 mx-4">
                <div class="my-2 mx-1 flex flex-row space-x-4">
                    <textarea
                        class="shadow-sm block sm:text-sm border-gray-300 rounded-md h-40"
                        placeholder="Customer notes"
                        name=""
                        id=""
                        rows="3"
                        cols="150"
                        v-model="transaction[0].notes"
                    ></textarea>

                    <div class="flex flex-col space-y-2 w-1/2 lg:full ">
                        <div>
                            <button
                                class="bg-purple-darken w-40 px-2 md:px-6 py-2 border border-transparent rounded-md shadow-sm text-xs md:text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                                @click="popModal()"
                            >
                                Print Labels
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-2 md:px-6 py-2 border border-transparent rounded-md shadow-sm md:text-sm text-xs font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Print Barcodes
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Send New Kit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- textarea 2 -->

                <div class="my-2 mx-1 flex flex-row space-x-4">
                    <textarea
                        class="shadow-sm block sm:text-sm border-gray-300 rounded-md "
                        placeholder="MET 3-2-22-Incoming via text"
                        name=""
                        id=""
                        rows="3"
                        cols="150"
                    ></textarea>

                    <div class="flex flex-col space-y-2 w-1/2 lg:full">
                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Email (Pictures & Cnotes)
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Email (Offer, Cnotes & Pictures)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col flex-wrap md:flex-row  my-4 mx-8 space-x-4 py-4 w-full"
        >
            <div class="ml-4 lg:ml-0" v-for="tag in bottom_tags" :key="tag.id">
                <input
                    @change="saveBottomTags(tag.id)"
                    type="checkbox"
                    :id="tag.id"
                    :name="tag.name"
                    class="mx-2"
                    :value="tag.id"
                />
                <label :for="tag.id">{{ tag.name }}</label>
            </div>
        </div>

        <div class="my-4">
            <AdminImages />
        </div>

        <!-- add item start -->

        <PrintLabel
            :transaction="transaction"
            @close="popUp = false"
            v-if="popUp"
        />

        <!-- add item end -->
    </div>
</template>

<script>
import { reactive, ref, computed } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import AdminImages from './AdminImages.vue'
import PrintLabel from '../Components/PrintLabel.vue'
import { notify } from 'notiwind'

export default {
    components: { AppLayout, PrintLabel, AdminImages },
    props: ['transaction', 'bottom_tags', 'statuses', 'root'],
    setup (props) {
        const popUp = ref(false)
        const popModal = () => {
            popUp.value = true
        }
        const transaction_id = props.root.id

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

        function saveBottomTags (tag_id) {
            axios
                .post('/transaction/tag', { tag_id, transaction_id })
                .then(res => console.log(res))
                .catch(error => console.log(error))
        }

        return { popUp, popModal, transaction_id, saveBottomTags, onClickTop, onClickBot }
    }
}
</script>
