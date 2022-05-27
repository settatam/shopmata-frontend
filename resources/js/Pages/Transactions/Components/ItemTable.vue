<template>
    <div class="rounded-md bg-white mt-8 overflow-x-auto lg:mx-2">
        <!-- add item start -->
        <div class="flex flex-row justify-start ml-3 mr-3 py-4">
            <div>
                <button
                    class="bg-purple-darken px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                    type="submit"
                    @click="popModal()"
                >
                    Add Item
                </button>
            </div>
        </div>

        <AddItem
            @it-added="pushEditValue"
            @close-modal="pushValue"
            :root="root"
            :categories="categories"
            @close="popUp = false"
            v-if="popUp"
        />
        <!-- add item end -->

        <!-- Edit modal -->
        <EditItem
            @close-modal="pushResponse"
            :root="root"
            :categories="categories"
            @close="EditPopUp = false"
            v-if="EditPopUp"
            :item="item"
            @it-edited="pushEditValue"
        />

        <table class="min-w-full">
            <colgroup>
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
                <col span="1" style="width: 5%" />
            </colgroup>

            <!-- <thead class="border-b bg-purple-darken "> -->
            <tr class="border-b bg-purple-darken">
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-4 text-left"
                    scope="col"
                >
                    TYPE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    PICTURE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    DESCRIPTION
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    QTY
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    OVERRIDE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    DWT
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    PRICE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    INOTES
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    EDIT/DELETE
                </th>
            </tr>
            <!-- </thead> -->
            <tbody>
                <tr
                    v-for="(transactionItem, index) in transactionItems"
                    :key="transactionItem.id"
                >
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{
                            transactionItem.category
                                ? transactionItem.category.name
                                : "----"
                        }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        <div>
                            <ImageModal
                                :enlargedImage="
                                    transactionItem.images.length
                                        ? transactionItem.images[0].url
                                        : null
                                "
                                alt=""
                                @close="imagePopUp = false"
                                v-if="imagePopUp"
                            />
                            <img
                                @click="popImageModal(index)"
                                :src="
                                    transactionItem.images.length
                                        ? transactionItem.images[0].url
                                        : null
                                "
                                alt=""
                                class="cursor-pointer"
                            />
                        </div>
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-normal break-words"
                    >
                        {{ transactionItem.description }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transactionItem.quantity }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transactionItem.override }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transactionItem.dwt }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transactionItem.price }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transactionItem.inotes }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        <p>
                            <span
                                href=" "
                                class="font-medium text-indigo-600 hover:text-purple-darken cursor-pointer"
                                @click="EditPopModal(transactionItem)"
                            >
                                Edit
                            </span>
                            /
                            <span
                                class="cursor-pointer font-medium text-black hover:text-purple-darken"
                                @click="deleteItem(transactionItem.id, index)"
                            >
                                Delete
                            </span>
                        </p>
                    </td>
                </tr>

                <!-- total ish -->
                <tr class="bg-gray-background border-4 border-white">
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>

                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        {{
                            transactionItems.length
                                ? transactionItems.length
                                : 0
                        }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        {{ totalDwt }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        {{ root.est_value }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap text-right"
                    >
                        Profit Percentage:
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        {{ root.profit_percent }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { reactive, ref, computed } from "@vue/reactivity";
import AppLayout from "../../../Layouts/AppLayout.vue";
import AddItem from "../Components/AddItem.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import ImageModal from "./ImageModal.vue";
import EditItem from "./EditItem.vue";
import notification from "../../../Utils/notification";

export default {
    components: { AppLayout, AddItem, ImageModal, EditItem },
    props: ["items", "categories", "root"],

    setup(props) {
        const { onClickTop, onClickBot } = notification();
        let items = props.items;

        const successMessage = ref("");
        const transactionItems = ref(items);

        const popUp = ref(false);
        const popModal = () => {
            popUp.value = true;
        };
        const loading = ref(false);
        const item = ref(null);

        // enlarge
        const imagePopUp = ref(false);
        const selected = ref(null);
        const popImageModal = (index) => {
            selected.value = index;
            imagePopUp.value = true;
        };
        // Edit modal pop up
        const EditPopUp = ref(false);
        const EditPopModal = (i) => {
            item.value = i;
            EditPopUp.value = true;
        };

        const totalDwt = computed(() => {
            let sum = 0;
            items.forEach((item) => {
                return (sum += parseFloat(item.dwt));
            });
            return sum.toFixed(2);
        });

        const estimatedProfit = computed(() => {
            return root.est_val;
        });

        const percentProfit = computed(() => {
            return root.est_val;
        });

        const totalPrice = computed(() => {
            let sum = 0;
            items.forEach((item) => {
                return (sum += parseFloat(item.price));
            });
            return sum.toFixed(2);
        });

        function pushValue(res) {
            popUp.value = res.data;
        }

        function pushEditValue(res) {
            transactionItems.value = res.data.items;
        }

        function Edited(res) {
            cosole.log(res);
        }

        function pushResponse(res) {
            EditPopUp.value = false;
        }

        function deleteItem(id, index) {
            axios
                .delete(`/admin/items/${id}`)
                .then((res) => {
                    loading.value = false;
                    transactionItems.value = res.data.items;
                    successMessage.value = "Item deleted";
                    setTimeout(onClickTop(successMessage.value), 2000);
                })
                .catch((error) => {
                    loading.value = false;
                    successMessage.value = "Error processing your request";
                    setTimeout(onClickBot(successMessage.value), 2000);
                });
        }

        return {
            popUp,
            popModal,
            EditPopUp,
            EditPopModal,
            totalDwt,
            totalPrice,
            pushResponse,
            pushValue,
            transactionItems,
            imagePopUp,
            selected,
            popImageModal,
            deleteItem,
            pushEditValue,
            item,
            Edited,
            estimatedProfit,
            percentProfit,
        };
    },
};
</script>
