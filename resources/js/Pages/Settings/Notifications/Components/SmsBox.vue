<template>
    <div class="flex-1 max-h-screen xl:overflow-y-auto">
        <div class="w-auto  lg:ml-7 lg:mr-2">
            <div class="px-4 md:px-8 pb-8 pt-6  mb-6 bg-white">
                <div class="w-auto relative">
                    <label class="block mt-4 mb-2 bg-transparent">
                        SMS subject
                    </label>
                    <input
                        type="text"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        :placeholder="order.subject"
                        v-model.trim="order.subject"
                        required
                    />
                    <error-icon
                        class="absolute top-11 right-2.5"
                        v-show="subjectError"
                    />
                </div>
                <!-- message textarea -->
                <div class="w-auto relative">
                    <label class="block mt-4 mb-2 bg-transparent">
                        Message
                    </label>
                    <textarea
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm  border-gray-300 h-32 rounded-md"
                        v-model.trim="order.message"
                        required
                    ></textarea>
                    <error-icon
                        class="absolute top-1 left-40"
                        v-show="bodyError"
                    />
                </div>
                <!-- message textare ends -->

                <!-- schedule start -->
                <div class="w-auto relative">
                    <div>
                        <label class="block mt-4 mb-2 bg-transparent">
                            Schedule a Message
                        </label>
                        <select
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                        >
                            <option value="">Immediately</option>
                        </select>
                    </div>
                </div>
                <!-- schedule end -->

                <!-- conditions start -->
                <div class="w-auto relative">
                    <div>
                        <label class="block mt-4 mb-2 bg-transparent">
                            Schedule a Message
                        </label>
                            <div
                                class="flex justify-between md:flex-row lg:justify-between space-x-2 mt-4"
                            >
                                <div class="w-4.5/10 lg:w-3/10">
                                    <select
                                        name="options"
                                        id=""
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none mb-2 lg:mb-0"
                                    >
                                        <option value="">Immediately</option>
                                    </select>
                                </div>
                                <div class="w-4.5/10 lg:w-3/10">
                                    <select
                                        name="conditions"
                                        id=""
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none"
                                    >
                                        <option value="">Immediately</option>
                                    </select>
                                </div>
                                <div class="w-4.5/10 lg:w-3/10 mb-2">
                                    <select
                                        name="state"
                                        id=""
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 w-full hover:bg-gray-50 focus:outline-none"
                                    >
                                        <option value="">Immediately</option>
                                    </select>
                                    
                                </div>
                            </div>
                    </div>
                </div>
                <!-- conditions end -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['order']
}
</script>
