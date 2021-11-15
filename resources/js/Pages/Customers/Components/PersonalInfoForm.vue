<template>
    <div class="w-full px-9">
        <div class="mt-7 mb-2">
            <h1
                class="
                    text-2xl
                    font-bold
                    leading-7
                    text-gray-900
                    sm:leading-9 sm:truncate
                "
            >
                Personal Information
            </h1>
        </div>
        <div class="border-t border-gray-200 -mx-8"></div>
        <div>
            <div class="flex flex-wrap mb-4 mt-3.5">
                <div class="form-group required w-full mb-6 md:pr-3 md:mb-0">
                    <label
                        class="
                            block
                            text-black
                            font-semibold
                            mb-2
                            bg-transparent
                        "
                        for="full_name"
                    >
                        Full Name
                    </label>
                    <input
                        type="text"
                        name="fullName"
                        id="fullName"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder="Full Name"
                        v-model="info.full_name"
                    />
                    <span
                        v-if="v$.info.full_name.$error"
                        class="text-red-400"
                        >{{ v$.info.full_name.$errors[0].$message }}</span
                    >
                </div>
                <!-- <div
                    class="
                        form-group
                        required
                        w-full
                        md:w-1/2
                        mb-6
                        md:mb-0 md:pl-3
                    "
                >
                    <label
                        class="
                            block
                            text-black
                            font-semibold
                            mb-2
                            bg-transparent
                        "
                        for="last_name"
                    >
                        Last Name
                    </label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder="Last Name"
                        v-model="info.last_name"
                    />
                    <span
                        v-if="v$.info.last_name.$error"
                        class="text-red-400"
                        >{{ v$.info.last_name.$errors[0].$message }}</span
                    >
                </div> -->
            </div>
            <div class="flex flex-wrap mb-4">
                <div class="form-group required w-full md:mb-0">
                    <label
                        class="
                            block
                            text-black
                            font-semibold
                            mb-2
                            bg-transparent
                        "
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        v-model="info.email"
                        type="text"
                        name="email"
                        id="email"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder="you@example.com"
                    />
                    <span v-if="v$.info.email.$error" class="text-red-400">{{
                        v$.info.email.$errors[0].$message
                    }}</span>
                </div>
            </div>
            <div class="flex flex-wrap mb-6.5">
                <div class="form-group required w-full mb-6 md:mb-0">
                    <label
                        class="
                            block
                            text-black
                            font-semibold
                            mb-2
                            bg-transparent
                        "
                        for="phone_number"
                    >
                        Phone number
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center"
                        >
                            <label for="country" class="sr-only">Country</label>
                            <select
                                id="country"
                                name="country"
                                class="
                                    focus:ring-indigo-500
                                    focus:border-indigo-500
                                    h-full
                                    py-0
                                    pl-3
                                    pr-7
                                    border-transparent
                                    bg-transparent
                                    text-gray-500
                                    sm:text-sm
                                    rounded-md
                                "
                            >
                                <option>US</option>
                                <option>NG</option>
                                <option>EU</option>
                            </select>
                        </div>
                        <input
                            v-model="info.phone_number"
                            type="text"
                            name="phone-number"
                            id="phone-number"
                            class="
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                pl-16
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder="+1 (555) 987-6543"
                        />
                    </div>
                    <span
                        v-if="v$.info.phone_number.$error"
                        class="text-red-400"
                        >{{ v$.info.phone_number.$errors[0].$message }}</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, helpers, email } from "@vuelidate/validators";

export default {
    name: "personal-info-form",
    props: ["info"],

    data() {
        return {
            v$: useVuelidate(),
        };
    },
    validations() {
        return {
            info: {
                full_name: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                },
                // last_name: {
                //     required: helpers.withMessage(
                //         "This field cannot be empty",
                //         required
                //     ),
                // },
                email: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required,
                        email
                    ),
                },
                phone_number: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                },
            },
        };
    },
};
</script>
