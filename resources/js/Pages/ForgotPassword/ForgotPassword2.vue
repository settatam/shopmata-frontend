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
                <h1 class="font-bold text-xl">
                    We Sent You a Password Reset Link
                </h1>
            </div>

            <div class="mx-0 w-38">
                <p class="text-xs text-gray-lighter text-center">
                    If you provided a valid email, we've sent an email to
                    {{ store.email }} with a link to reset your password.
                </p>
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

export default {
    data () {},
    components: { ArrowLeftIcon, LockClosedIcon },
    setup () {
        const store = reactive({
            step: 2,
            email: ''
        })
        const loading = ref(false)
        const submit = () => {
            loading.value = true
        }

        return { store, loading, submit }
    }
}
</script>
