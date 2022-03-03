<template>
    <div class="min-h-screen bg-white flex mx-4 px-8 py-8">
        <div class="">
            <div class="px-2 py-2 bg-gray-lightest">
                <ArrowLeftIcon class="h-5 w-5  text-black" />
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full">
            <!-- big lock icon start -->
            <div
                class="bg-gray-lightest p-6 m-6"
                :style="{ 'border-radius': '50%' }"
            >
                <LockClosedIcon class="h-10 w-10 text-purple-darken" />
            </div>

            <!-- big lock icon ends -->
            <div class="my-1 py-1">
                <h1 class="font-bold text-xl">Password Reset Successfully</h1>
            </div>

            <div class="mx-0 w-38">
                <p class="text-xs text-gray-lighter text-center">
                    You have successfully changed your password. Use the button
                    below to login
                </p>
            </div>

            <!-- buttons -->
            <div class="mt-6">
                <button
                    v-if="loading"
                    :disabled="loading"
                    type="submit"
                    :class="{
                        disabled: loading,
                        'opacity-25 cursor-not-allowed': loading
                    }"
                    class="flex justify-center w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                >
                    <LoadingSpinner v-if="loading" />

                    Continue to Login
                </button>

                <!-- v-else -->
                <button
                    v-else
                    type="submit"
                    class="w-full lg:w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                >
                    Continue to Login
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed, watch } from 'vue'
import useVuelidate from '@vuelidate/core'
import { Inertia } from '@inertiajs/inertia'
import { required, email, helpers } from '@vuelidate/validators'
import { ArrowLeftIcon } from '@heroicons/vue/solid'
import { LockClosedIcon } from '@heroicons/vue/outline'
import LoadingSpinner from '../../Components/LoadingSpinner.vue'

export default {
    data () {},
    components: { ArrowLeftIcon, LoadingSpinner, LockClosedIcon },
    setup () {
        const store = reactive({
            step: 4
        })
        const loading = ref(false)
        const submit = () => {
            loading.value = true
        }

        return { store, loading, submit }
    }
}
</script>
