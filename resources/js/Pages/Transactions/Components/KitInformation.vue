<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Kit Information</h1>
        </div>

        <form action="" method="post" class="px-3">
            <div class="p-4 space-y-2">
                <select
                    id="sales_method_id"
                    name="location"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="0">Select</option>
                </select>
            </div>

            <div class="my-2 mx-4">
                <textarea
                    class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md "
                    placeholder="Write a delivery note ......."
                    name=""
                    id=""
                    rows="10"
                ></textarea>
            </div>

            <!-- images start -->
            <div class="">
                <div class="p-4 flex flex-row justify-between">
                    <div>
                        <input type="checkbox" id="vehicle1" name="Tyvek" />
                        <label for="vehicle1" class="text-xs lg:text-sm">
                            Tyvek</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle2" name="Fedex" />
                        <label for="vehicle2" class="text-xs lg:text-sm">
                            Fedex</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle3" name="Customer" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            Customer</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle3" name="Other" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            Other</label
                        >
                    </div>
                </div>

                <div class="p-4 flex flex-row justify-between">
                    <div>
                        <input type="checkbox" id="vehicle3" name="10%" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            10%</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle3" name="FedexGr" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            Fedex Gr</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle3" name="FedexEx" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            Fedex Ex</label
                        >
                    </div>
                    <div>
                        <input type="checkbox" id="vehicle3" name="Box" />
                        <label for="vehicle3" class="text-xs lg:text-sm">
                            Box</label
                        >
                    </div>
                </div>
            </div>

            <!-- images end -->
        </form>

        <!-- sms start -->
        <div>
            <Sms class="my-4"/>
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'
import Sms from '../Components/Sms.vue'

export default {
    components: { AppLayout, Sms },
    setup () {
        return {}
    }
}
</script>
