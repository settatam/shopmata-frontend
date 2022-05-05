<template>
    <div class=" rounded-md mt-18 bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1 class="text-white">Transaction Timeline</h1>
        </div>

        <!-- image modal start -->
        <AddItem :categories="categories" @close="popUp = false" v-if="popUp" />
        <!-- image modal ends -->

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
                            name="transaction_status"
                            v-model="currentTransaction.status_id"
                            @change="onChange($event)"
                        >
                            <option
                                v-for="status in statuses"
                                :key="status.index"
                                :value="status.status_id"
                                >{{ status.name }}</option
                            >
                        </select>
                    </div>
                    <div class="ml-6">
                        <button @click="updateTransaction('status')" class="bg-purple-darken py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken mx-2 md:ml-8 lg:mx-0 px-2"
                            type="button">Confirm Status
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
                            placeholder="Offer"
                            autocomplete="off"
                            v-model="currentTransaction.final_offer"
                        />
                        <div class="flex flex-row ml-1">
                            <input
                                type="checkbox"
                                class="text-xs my-2 mx-2"
                                name="2ndoffer"
                                id="2ndoffer"
                                v-model="transaction.offers.length"
                            />
                            <label class="mt-1" for="2ndoffer">2nd Offer</label>
                        </div>
                    </div>
                    <div class="">
                        <button
                            class="bg-purple-darken py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken mx-2 lg:mx-0 px-2"
                            type="button"
                            @click="updateTransaction('offer')"
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
            <div class="flex flex-col p-4  lg:w-1/3">
                <div v-for="status in timeline" :key="status.index">
                    <p
                        :class="{
                            'text-black': !status.date,
                            'text-green-darker': status.date
                        }"
                        class="">
                        {{ status.name }}:
                        <component
                            :is="status.icon"
                            class="mx-2 flex-shrink-0 inline-flex h-6 w-6"  aria-hidden="true"
                        />
                        <span v-if="status.date">
                            {{ moment(status.date).format('MM-DD-YYYY') }}
                        </span>
                        <span v-else>
                            {{}}
                        </span>
                    </p>
                </div>
            </div>

            <div class="flex flex-col lg:w-2/3 mx-4">
                <div class="my-2 mx-1 flex flex-row space-x-4">
                    <textarea
                        class="shadow-sm block sm:text-sm border-gray-300 rounded-md h-40"
                        placeholder="Customer notes"
                        name="public"
                        id=""
                        rows="3"
                        cols="150"
                        v-model="messagePublic"
                    >
                    </textarea>

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
                            <a
                                class="bg-purple-darken w-40 px-2 md:px-6 py-2 border border-transparent rounded-md shadow-sm md:text-sm text-xs font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                                :href="'/admin/transactions/'+transaction.id+'/barcode'" target="_blank"
                            >
                                Print Barcodes
                            </a>
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
                        name="private"
                        id=""
                        rows="3"
                        cols="150"
                        v-model="messagePrivate"
                    ></textarea>

                    <div class="flex flex-col space-y-2 w-1/2 lg:full">
                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="button"
                                @click="updateTransaction('message')"
                            >
                                Email (Pictures &amp; Cnotes)
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="button"
                                @click="updateTransaction('status_id', 50)"
                            >
                                Email (Offer, Cnotes &amp; Pictures)
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Return Label
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Reject Offer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col flex-wrap lg:flex-row  my-4 mx-8 space-x-4 py-4 w-full"
        >
            <div class="ml-4 lg:ml-0" v-for="tag in bottom_tags" :key="tag.id">
                <input
                    v-if="checkedList.includes(tag.id)"
                    checked
                    @change="saveBottomTags(tag.id)"
                    type="checkbox"
                    :id="tag.id"
                    :name="tag.name"
                    class="mx-2"
                    :value="tag.id"
                />

                <input
                    v-else
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
            <AdminImages :root="transaction" />
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
import { watch } from 'vue'

import debounce from 'lodash/debounce'
import AddItem from '../Components/AddItem.vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import AdminImages from './AdminImages.vue'
import PrintLabel from '../Components/PrintLabel.vue'
import { notify } from 'notiwind'
import moment from 'moment'
import {XCircleIcon, MinusCircleIcon, CheckCircleIcon} from "@heroicons/vue/outline";

export default {
    components: {
        AppLayout,
        PrintLabel,
        AdminImages,
        AddItem,
        CheckCircleIcon,
        XCircleIcon,
        MinusCircleIcon
    },
    props: ['transaction', 'bottom_tags', 'statuses', 'root', 'timeline'],
    emits: ['transaction-updated'],
    created: function () {
        this.moment = moment
    },
    setup (props, { emit }) {
        const popUp = ref(false)
        const successMessage = ref('')
        const popModal = () => {
            popUp.value = true
        }
        const notes = props.transaction
        const transaction_id = props.root.id
        const pickedTags = props.root.tags
        const checkedList = computed(() => {
            let myArray = []
            pickedTags.forEach(item => {
                return myArray.push(item.tag_id)
            })

            return myArray
        })
        const customer_id = props.root.customer.id
        const messagePrivate = ref('')
        const messagePublic = ref('')
        let message = null
        let tmPrivate = null
        let tmPublic = null
        let type = null

        const transactionStatus = ref('')
        const transactionOffer = reactive({
            secondOffer: '',
            offer: ''
        })

        const currentTransaction = ref(props.transaction);


        console.log(currentTransaction)

        tmPublic =
            null !== props.root.public_note ? props.root.public_note.notes : ''
        tmPrivate =
            null !== props.root.private_note
                ? props.root.private_note.notes
                : ''
        messagePublic.value = tmPublic
        messagePrivate.value = tmPrivate

        watch(
            [messagePublic, messagePrivate],
            debounce(function (value) {

                if (typeof value[0] !== 'undefined' && tmPublic == value[0]) {
                    type = 'private'
                    message = messagePrivate.value
                } else {
                    type = 'public'
                    message = messagePublic.value
                }

                axios
                    .post('/admin/transaction/notes', {
                        transaction_id,
                        message: message,
                        customer_id,
                        type: type
                    })
                    .then(res => {
                        successMessage.value = 'Note updated'
                        setTimeout(onClickTop, 2000)
                    })
                    .catch(error => {
                        successMessage.value = 'Something went wrong.'
                        setTimeout(onClickBot, 2000)
                    })
            }, 3000)
        )

        function updateTransaction(event, status_id=null) {
            let data = {};
            switch(event) {
                case 'status':
                    data = {
                        field: 'status_id',
                        value: this.currentTransaction.status_id
                    }
                    break;
                case 'message':
                      data = {
                        field: 'message',
                        value: this.currentTransaction.status_id
                      }
                    break;
                case 'offer':
                    data = {
                        field: 'offer',
                        value: this.currentTransaction.final_offer
                      }
                    break;
                case 'sms':
                    data = {
                        field: 'sms',
                        value: this.currentTransaction.final_offer
                      }
                    break;
            }

            emit('transaction-updated', data)
        }

        // notification
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

        function onChange(event){
            console.log(event.target.value);
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
        // notification ends

        // save notes end

        // Save tags
        function saveBottomTags (tag_id) {
            if (this.checkedList.includes(tag_id)) {
                axios
                    .post('/transaction/tag', { tag_id, transaction_id })
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
            popUp,
            popModal,
            transaction_id,
            saveBottomTags,
            onClickTop,
            onClickBot,
            pickedTags,
            checkedList,
            messagePrivate,
            messagePublic,
            //saveNote,
            transactionStatus,
            transactionOffer,
            notes,
            updateTransaction,
            onChange,
            currentTransaction
        }
    }
}
</script>
