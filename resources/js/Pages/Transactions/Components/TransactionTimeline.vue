<template>
    <div class=" rounded-md mt-4 bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1 class="text-white">Transaction Timeline</h1>
        </div>

        <div
            class="flex flex-col md:flex-col lg:flex-row lg:space-x-2 justify-between mx-4"
        >
            <div class=" my-4 flex flex-row">
                <label class="pt-2" for="">Status: </label>
                <div class="flex flex-col lg:flex-row ">
                    <div>
                        <input
                            type="search"
                            :disabled="true"
                            class="py-3 text-sm text-black rounded-md focus:outline-none focus:bg-white disabled:bg-gray-background mx-2"
                            placeholder="Kit Received"
                            autocomplete="off"
                        />
                        <p class="text-xs my-2 mx-2 text-red-600">
                            Delete transaction
                        </p>
                    </div>
                    <div>
                        <button
                            class="bg-purple-darken py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken mx-2 lg:mx-0 px-2"
                            type="submit"
                        >
                            Confirm Status
                        </button>
                    </div>
                </div>
            </div>

            <div class=" my-4 flex flex-row">
                <label class="pt-2" for="">Status: </label>
                <div class="flex flex-col lg:flex-row ">
                    <div>
                        <input
                            type="search"
                            :disabled="true"
                            class="py-3 text-sm text-black rounded-md focus:outline-none focus:bg-white disabled:bg-gray-background mx-2"
                            placeholder="Kit Received"
                            autocomplete="off"
                        />
                        <p class="text-xs my-2 mx-2 text-red-600">
                            Delete offer
                        </p>
                    </div>
                    <div>
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

        <div class="flex flex-col md:flex-row text-black text-xs md:text-sm">
            <div class="flex flex-col p-4 space-y-3 lg:w-1/2">
                <p class="text-green-darker">Kit requested</p>
                <p class="text-green-darker">Kit sent</p>
                <p class="text-green-darker">Package Received</p>
                <p>Offer given</p>
                <p>Offer accepted</p>
                <p>Payment processed</p>
            </div>

            <div class="flex flex-col lg:w-1/2 mx-4">
                <div class="my-2 mx-1 flex flex-row space-x-4">
                    <textarea
                        class="shadow-sm block sm:text-sm border-gray-300 rounded-md "
                        placeholder="Customer Notes"
                        name=""
                        id=""
                        rows="3"
                        cols="60"
                    ></textarea>

                    <div class="flex flex-col space-y-2 w-1/2 lg:full ">
                        <div>
                            <button
                                class="bg-purple-darken w-40 px-2 md:px-6 py-2 border border-transparent rounded-md shadow-sm text-xs md:text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
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
                        cols="60"
                    ></textarea>

                    <div class="flex flex-col space-y-2 w-1/2 lg:full">
                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Send New Kit
                            </button>
                        </div>

                        <div>
                            <button
                                class="bg-purple-darken w-40 px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                                type="submit"
                            >
                                Email (Pictures & Cnotes)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout },
    setup () {
        return {}
    }
}
</script>
