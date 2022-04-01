<template>
    <div class=" rounded-md bg-white mt-8 px-8 lg:mx-2">
        <div class="my-4">
            <h1 class="font-bold text-2xl my-8">
                Admin Images
            </h1>

            <div id="flexcontainer" class="flex flex-col lg:flex-row space-x-2">
                <div class="lg:w-5/6 sm:w-full">
                    <label
                        class="flex justify-center  h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                    >
                        <span class="flex items-center space-x-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                />
                            </svg>
                            <span class="font-medium text-gray-600">
                                Drop files to Attach, or
                                <span class="text-blue-600 underline"
                                    >browse</span
                                >
                            </span>
                        </span>
                        <input type="file" name="file_upload" class="hidden" />
                    </label>
                </div>

                <div class="flex lg:flex-col sm:justify-around sm:mt-2 lg:space-y-2 w-full lg:w-1/6 lg:full">
                    <div>
                        <button
                            class="bg-purple-darken w-40 px-6 md: py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
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
</template>

<script>
import { reactive, ref, computed } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout }
}
</script>
