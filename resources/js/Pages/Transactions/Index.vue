<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3">

            <ConfirmationModal
                :open="openConfirmationModal"
                @close="closeConfirmationModal"
            >
                <template #header>
                    {{ confirmationHeader }}
                </template>
                <template #body>
                    {{ confirmationBody }}
                </template>
            </ConfirmationModal>
            <shopmata-table :filters="filters" @action="doAction" />
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive, computed, onMounted } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import axios from "axios";
import { SearchIcon, PlusIcon } from "@heroicons/vue/solid";
import { MailIcon, PhoneIcon } from "@heroicons/vue/outline";
import Pagination from "../../Components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import DeleteModal from "../../Components/DeleteModal.vue";
import notification from "../../Utils/notification";
import ShopmataTable from "../Widgets/ShopmataTable";
import ConfirmationModal from "../../Components/ConfirmationModal";
import * as api from "../../api";

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};

export default {
    components: {
        ConfirmationModal,
        AppLayout,
        SearchIcon,
        MailIcon,
        PlusIcon,
        PhoneIcon,
        Pagination,
        DeleteModal,
        ShopmataTable,
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array,
        filters: Object,
    },
    setup({ navigation, transactions }) {
        const { onClickTop, onClickBot } = notification();
        const imageExists = ref(true);
        const loading = false;
        const isChecked = ref(false);
        const notifications = notifications;
        const massActionChoice = ref("choose");
        const isDelete = ref(false);
        const filterNumber = ref("choose");
        const deleteProps = reactive({
            url: "/admin/transactions/delete",
            item: "Transactions",
        });
        const checkedTransactions = ref([]);
        const openConfirmationModal = ref(false);
        const confirmationHeader = ref("");
        const confirmationBody = ref("");
        const selectedTransactions = ref([]);
        const confirmationFor = ref({});

        onMounted(() => {
            // this.$emit('doNavigation', navigation)
        });

        function success(list, page) {
            filterLists.value = list;
            pagination.value = page;
            loading.value = false;
        }

        function checkAll() {
            isChecked.value = !isChecked.value;
        }

        // function sendAction () {
        //     let data = {
        //         transactions: checkedTransactions.value,
        //         action: massActionChoice.value
        //     }
        //     switch (massActionChoice.value) {
        //         case 'delete':
        //             isDelete.value = true
        //             confirmationBody.value = 'Are you sure you want to delete these transactions?'
        //             confirmationHeader.value = 'Delete Transactions'
        //             openConfirmationModal.value = true;
        //             break
        //         case 'label_to':
        //         case 'label_from':
        //         case 'barcode':
        //             Inertia.post(
        //                 '/admin/transactions/bulk-actions/barcode',
        //                 data
        //             )
        //             break
        //     }
        // }

        function close() {
            isDelete.value = false;
            Inertia.visit("/admin/transactions", {
                method: "get",
            });
        }

        function filterTransactions() {
            switch (filterNumber.value) {
                case "choose":
                    break;
                default:
                    Inertia.visit(
                        `/admin/transactions?per_page=${filterNumber.value}`,
                        {
                            method: "get",
                        }
                    );
            }
        }

        function doAction(action, selectedItems) {
            console.log(action);
            let formData = [];
            // for(let i=0; i<action.formGroups.length; i++) {
            //     //formData.push(actions.value[index].formGroups[i].field.attributes)
            //     let name = action.formGroups[i].field.attributes.name
            //     let data = {};
            //     data[name] = action.formGroups[i].field.attributes.value;
            //     formData.push(data);
            // }
            let name = action.formGroups[0].field.attributes.name;
            let value = action.formGroups[0].field.attributes.value;
            //add requires danger confirmation
            //sendAction(formData, selectedItems);
            selectedTransactions.value = selectedItems.map((t) => t.data);
            if (name == "status") {
                sendAction(name, value);
            } else if (name == "actions") {
                if (value == "Delete") {
                    confirmationBody.value =
                        "Are you sure you want to delete these transactions?";
                    confirmationHeader.value = "Delete Transactions";
                    openConfirmationModal.value = true;
                    confirmationFor.value = {
                        name: "actions",
                        value: "Delete",
                    }
                } else {
                    sendAction(name, value);
                }
            }
        }

        function closeConfirmationModal(confirmation) {
            openConfirmationModal.value = false;
            if (confirmation)
                sendAction(
                    confirmationFor.value.name,
                    confirmationFor.value.value
                );
        }

        function sendAction(action, value) {
            let data = {
                transactions: selectedTransactions.value,
                action: value,
            };
            switch (action) {
                case "status":
                    console.log("This is the status");
                    break;
                case "actions":
                    switch (value) {
                        case "Delete":
                            alert(
                                "this is the part where we actually delete the item"
                            );
                            break;
                        case "Send Message":
                            Inertia.get(
                                "/admin/transactions/bulk/messages",
                                data,
                                {
                                    replace: true,
                                }
                            );
                            break;
                        case "Create Barcodes":
                        case "Rejected By Admin":
                        case "Create Shipping Label":
                            Inertia.post(
                                api.bulkActionForTransactions(),
                                data
                            );
                            break;
                    }
            }

            confirmationFor.value = "";
        }

        return {
            loading,
            transactions,
            statusStyles,
            imageExists,
            isChecked,
            checkAll,
            massActionChoice,
            sendAction,
            isDelete,
            deleteProps,
            close,
            checkedTransactions,
            filterNumber,
            filterTransactions,
            doAction,
            openConfirmationModal,
            confirmationBody,
            confirmationHeader,
            closeConfirmationModal,
        };
    },
};
</script>
