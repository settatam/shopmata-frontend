<template>
    <div class="min-h-screen bg-white flex mx-4 px-8 py-8">
        <!-- Page 1 start -->
        <div v-if="displayOne" class="flex flex-col w-full">

            <div class="w-8">
                <inertia-link href="/login" class="block px-2 py-2 bg-gray-200 cursor-pointer">
                    <ArrowLeftIcon class="h-5 w-5  text-black" />
                </inertia-link>
            </div>

            <div class="flex flex-col items-center w-full my-32">
                <div class="my-1 py-1 flex flex-row">
                    <h1 class="font-bold text-2xl mx-3">Forgot Password</h1>
                    <img src="../../../assets/padlockIcon.png" alt="" class="h-5 w-5">
                </div>
                <div class="mx-0 w-38">
                    <p class="text-xs text-gray-lighter text-center">
                        Enter your email address below and we will send you a
                        password reset link
                    </p>
                </div>

                <div class="mt-8">
                    <form
                        action=""
                        method="post"
                        class="w-auto"
                        v-on:submit.prevent="sendLink"
                    >
                        <div>
                            <label
                                for="email"
                                class="block text-xs font-normal text-gray-darker"
                            >
                                Email address
                            </label>
                            <div class="mt-1  rounded-md shadow-sm ">
                                <input
                                    :class="{
                                        'border-red-600': v$.email.$error,
                                        'border-gray-300': !v$.email.$error
                                    }"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    class="appearance-none cursor-pointer block px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-purple-darken focus:border-purple-darken sm:text-sm w-96"
                                    v-model="store.email"
                                />
                            </div>
                            <div class="mt-1">
                                <p
                                    class="text-red-600 text-xs"
                                    v-if="v$.email.$error"
                                >
                                    {{ v$.email.$errors[0].$message }}
                                </p>
                                <p class="text-red-600 text-xs" v-if="errors">
                                    {{ errors.email[0] }}
                                </p>
                            </div>
                        </div>

                        <!-- buttons -->
                        <div class="mt-6">
                            <button
                                v-if="!v$.$error"
                                :disabled="loading"
                                type="submit"
                                :class="{
                                    disabled: loading,
                                    'opacity-25 cursor-not-allowed': loading
                                }"
                                class="flex justify-center w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                            >
                                <LoadingSpinner v-if="loading" />

                                Send Link
                            </button>

                            <!-- v-else -->
                            <button
                                v-else
                                type="submit"
                                class="w-full lg:w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                            >
                                Send Link
                            </button>
                        </div>
                    </form>

                    <!-- footmarkers -->
                    <div class="mt-8">
                        <ul
                            class="text-xs text-gray-lighter flex flex-row justify-around w-full"
                        >
                            <li><a href="">Help</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page 1 end -->

        <!-- Page 2 start -->

        <div v-else class="flex flex-col w-full">
            <div class="w-8">
                <div
                    @click="backPageOne"
                    class="px-2 py-2 bg-gray-200 cursor-pointer"
                >
                    <ArrowLeftIcon class="h-5 w-5 text-black" />
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

        <!-- Page 2 end -->
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed } from 'vue'
import useVuelidate from '@vuelidate/core'
import { Inertia } from '@inertiajs/inertia'
import { required, email, helpers } from '@vuelidate/validators'
import { ArrowLeftIcon } from '@heroicons/vue/solid'
import LoadingSpinner from '../../Components/LoadingSpinner.vue'

export default {
    components: { ArrowLeftIcon, LoadingSpinner },
    setup () {
        const loading = ref(false)
        const store = reactive({
            step: 1,
            email: ''
        })
        const displayOne = ref(true)

        function backPageOne () {
            displayOne.value = true
            loading.value = false
        }

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage(
                        'Please enter an email address',
                        required
                    ),
                    email
                }
            }
        })

        const v$ = useVuelidate(rules, store)

        function sendLink () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            displayOne.value = false
            axios
                .post('/', store)
                .then(res => (displayOne.value = false))
                .catch(err => console.log(err))
        }

        return { v$, store, loading, sendLink, displayOne, backPageOne }
    }
}
</script>
