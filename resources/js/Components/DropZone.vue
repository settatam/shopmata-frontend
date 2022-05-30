<template>
    <div class="mt-1 sm:mt-0 sm:col-span-2" v-bind="getRootProps()">
        <input v-bind="getInputProps()" />
        <div
            class="flex justify-center mt-2 px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
        >
            <div class="space-y-1 text-center" v-if="isDragActive">
                Drop files here
            </div>
            <div class="space-y-1 text-center" v-else>
                <div class="flex justify-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="48"
                        height="48"
                        viewBox="0 0 48 48"
                        fill="none"
                        class="cursor-pointer"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M11.015 3.355C13.5137 1.20034 16.7006 0.0103463 20 0C26.725 0 32.3075 5 32.915 11.4475C36.895 12.01 40 15.3425 40 19.4325C40 23.9225 36.255 27.5 31.7175 27.5H25C24.6685 27.5 24.3505 27.3683 24.1161 27.1339C23.8817 26.8995 23.75 26.5815 23.75 26.25C23.75 25.9185 23.8817 25.6005 24.1161 25.3661C24.3505 25.1317 24.6685 25 25 25H31.72C34.9475 25 37.5 22.47 37.5 19.4325C37.5 16.3925 34.95 13.8625 31.7175 13.8625H30.4675V12.6125C30.47 7.0625 25.82 2.5 20 2.5C17.2997 2.51079 14.6921 3.48608 12.6475 5.25C10.755 6.88 9.765 8.845 9.765 10.3875V11.5075L8.6525 11.63C5.16 12.0125 2.5 14.88 2.5 18.295C2.5 21.9625 5.575 25 9.4525 25H15C15.3315 25 15.6495 25.1317 15.8839 25.3661C16.1183 25.6005 16.25 25.9185 16.25 26.25C16.25 26.5815 16.1183 26.8995 15.8839 27.1339C15.6495 27.3683 15.3315 27.5 15 27.5H9.4525C4.27 27.5 0 23.415 0 18.295C0 13.8875 3.165 10.2375 7.355 9.3125C7.7125 7.155 9.1 5.005 11.015 3.355V3.355Z"
                            fill="#CCCCCC"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M19.6878 15.7735C19.757 15.7042 19.8392 15.6491 19.9297 15.6116C20.0202 15.574 20.1172 15.5547 20.2152 15.5547C20.3131 15.5547 20.4102 15.574 20.5007 15.6116C20.5911 15.6491 20.6733 15.7042 20.7425 15.7735L25.2119 20.2429C25.3517 20.3827 25.4303 20.5724 25.4303 20.7702C25.4303 20.968 25.3517 21.1578 25.2119 21.2976C25.072 21.4375 24.8823 21.5161 24.6845 21.5161C24.4867 21.5161 24.297 21.4375 24.1571 21.2976L20.9601 18.0991V31.1987C20.9601 31.3962 20.8816 31.5857 20.7419 31.7254C20.6022 31.8651 20.4127 31.9436 20.2152 31.9436C20.0176 31.9436 19.8281 31.8651 19.6884 31.7254C19.5488 31.5857 19.4703 31.3962 19.4703 31.1987V18.0991L16.2732 21.2976C16.1333 21.4375 15.9436 21.5161 15.7458 21.5161C15.548 21.5161 15.3583 21.4375 15.2184 21.2976C15.0786 21.1578 15 20.968 15 20.7702C15 20.5724 15.0786 20.3827 15.2184 20.2429L19.6878 15.7735Z"
                            fill="#4338CA"
                        />
                    </svg>
                </div>
                <p class="pl-1 text-gray-600">
                    Drag and drop your image here or
                </p>
                <button
                    class="text-white bg-indigo-600 active:bg-indigo-600 border border-transparent text-center px-8 py-3 rounded flex mx-auto justify-center"
                >
                    <LoadingSpinner v-if="loading" />

                    <span>{{ text }} </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { useDropzone } from "vue3-dropzone";
import LoadingSpinner from "./LoadingSpinner.vue";
import notification from "../Utils/notification";
import fileUploader from "../Utils/fileUploader";

export default {
    components: {
        LoadingSpinner,
    },
    props: ["payload"],
    name: "UseDropzone",
    emits: ["add-image"],
    setup(props, { emit }) {
        console.log(props);
        const message = ref("");
        const loading = ref(false);
        const text = ref("Choose file");
        const { onClickTop, onClickBot } = notification();
        const { saveFiles } = fileUploader();

        const url = "/admin/images";

        function onDrop(acceptFiles, rejectReasons) {
            loading.value = true;
            text.value = "Uploading....";
            saveFiles(acceptFiles, props.payload)
                .then((res) => {
                    emit("add-image", res);
                    loading.value = false;
                    message.value = "Image uploaded successfully";
                    text.value = "Choose file";
                    setTimeout(onClickTop, 2000);
                })
                .catch((err) => {
                    loading.value = false;
                    message.value = "Error processing request";
                    setTimeout(onClickBot, 2000);
                    text.value = "Choose file";
                });

            return rejectReasons;
        }

        const { getRootProps, getInputProps, ...rest } = useDropzone({
            onDrop,
        });

        return {
            getRootProps,
            getInputProps,
            ...rest,
            loading,
            text,
        };
    },
};
</script>
