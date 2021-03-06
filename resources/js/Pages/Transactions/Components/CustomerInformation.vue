<template>
    <div class="rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Customer Information</h1>
        </div>

        <div class="p-4 space-y-2">
            <inertia-link
                class="text-purple-darken 2xl font-bold"
                :href="'/admin/customers/' + customer.id"
                >{{ customer.first_name }} {{ customer.last_name }} (ID
                {{ customer.id }})</inertia-link
            >
            |

            <a
                class="text-purple-darken 2xl font-bold"
                @click.prevent="sendLink($event)"
                href="#"> 
                {{tokenLinkText}}
             </a>
            <p class="font-bold text-xs lg:text-sm text-black">
                Address 1:
                <span class="font-normal">{{ customer.address.address }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Address 2:
                <span class="font-normal">{{ customer.address.address2 }}</span>
            </p>
            <p v-if="customer.state" class="font-bold text-xs lg:text-sm text-black">
                City, State, Zip:
                <span class="font-normal">{{ customer.address.city }}, {{ customer.address.state }},
                    {{ customer.address.zip }}</span>
            </p>
            <p v-else class="font-bold text-xs lg:text-sm text-black">
                City, State, Zip:
                <span class="font-normal">{{ customer.zip }}, {{ customer.zip }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Phone:
                <span class="font-normal">{{ customer.phone_number }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Home/Work:
                <span class="font-normal">{{}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Email:
                <a class="font-normal text-purple-darken">{{
                        customer.email
                }}</a>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Lead:
                <span class="font-normal">{{
                        null != customer.lead ? customer.lead.name : ""
                }}</span>
            </p>

            <p class="font-bold text-xs lg:text-sm text-black">
                DOB: <span class="font-normal">{{ customer.dob }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Gender:
                <span class="font-normal">{{ customer.gender }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                IP Address: <span class="font-normal">{{}}</span>
            </p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import AppLayout from "../../../Layouts/AppLayout.vue";
import { ref } from '@vue/reactivity';
import notification from "../../../Utils/notification";


export default {
    props: ["customer"],
    components: { AppLayout },
    setup(props) {
        const tokenLinkText = ref("Send login link");
        const loading       = ref(false);
        const { notifyAlert } = notification();

        function sendLink() {
            if(loading.value) return;
            tokenLinkText.value = "Sending........"
            axios.get('/admin/token/link/' + props.customer.id)
            .then((res) => {
                tokenLinkText.value = "Send login link"
                loading.value = false;
                setTimeout(
                    notifyAlert(
                        "Link sent",
                        "top",
                        "Success"
                    ),
                    2000
                );
                return;

            }).catch((err) => {
                tokenLinkText.value = "Send login link"
                loading.value = false;
                setTimeout(
                    notifyAlert(
                        "Error sending link",
                        "bottom",
                        "Error"
                    ),
                    2000
                );
            })
        }

        return {
            tokenLinkText,
            sendLink,
            loading
        };
    },
};
</script>
