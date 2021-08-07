<template>
  <div>
    <div v-bind="getRootProps()">
      <input v-bind="getInputProps()" />
      <p v-if="isDragActive">Drop the files here ...</p>
      <div class="border-2 border-dashed flex flex-col" v-else>
            <span>
              <svg class="mx-auto mt-10" xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 72 58" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.827 6.039C24.3247 2.16061 30.0611 0.0186233 36 0C48.105 0 58.1535 9 59.247 20.6055C66.411 21.618 72 27.6165 72 34.9785C72 43.0605 65.259 49.5 57.0915 49.5H45C44.4033 49.5 43.831 49.2629 43.409 48.841C42.9871 48.419 42.75 47.8467 42.75 47.25C42.75 46.6533 42.9871 46.081 43.409 45.659C43.831 45.2371 44.4033 45 45 45H57.096C62.9055 45 67.5 40.446 67.5 34.9785C67.5 29.5065 62.91 24.9525 57.0915 24.9525H54.8415V22.7025C54.846 12.7125 46.476 4.5 36 4.5C31.1394 4.51942 26.4458 6.27495 22.7655 9.45C19.359 12.384 17.577 15.921 17.577 18.6975V20.7135L15.5745 20.934C9.288 21.6225 4.5 26.784 4.5 32.931C4.5 39.5325 10.035 45 17.0145 45H27C27.5967 45 28.169 45.2371 28.591 45.659C29.0129 46.081 29.25 46.6533 29.25 47.25C29.25 47.8467 29.0129 48.419 28.591 48.841C28.169 49.2629 27.5967 49.5 27 49.5H17.0145C7.686 49.5 0 42.147 0 32.931C0 24.9975 5.697 18.4275 13.239 16.7625C13.8825 12.879 16.38 9.009 19.827 6.039Z" fill="#CCCCCC"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M35.438 28.3899C35.5626 28.265 35.7105 28.166 35.8734 28.0984C36.0363 28.0308 36.2109 27.996 36.3873 27.996C36.5637 27.996 36.7383 28.0308 36.9012 28.0984C37.0641 28.166 37.212 28.265 37.3366 28.3899L45.3814 36.4347C45.6331 36.6865 45.7746 37.0279 45.7746 37.384C45.7746 37.7401 45.6331 38.0815 45.3814 38.3333C45.1296 38.5851 44.7881 38.7265 44.4321 38.7265C44.076 38.7265 43.7346 38.5851 43.4828 38.3333L37.7281 32.5759V56.1552C37.7281 56.5108 37.5868 56.8518 37.3354 57.1033C37.0839 57.3547 36.7429 57.496 36.3873 57.496C36.0317 57.496 35.6907 57.3547 35.4392 57.1033C35.1878 56.8518 35.0465 56.5108 35.0465 56.1552V32.5759L29.2918 38.3333C29.04 38.5851 28.6985 38.7265 28.3425 38.7265C27.9864 38.7265 27.645 38.5851 27.3932 38.3333C27.1414 38.0815 27 37.7401 27 37.384C27 37.0279 27.1414 36.6865 27.3932 36.4347L35.438 28.3899Z" fill="#4F46E5"/>
              </svg>
            </span>
            <p class="mx-2 text-xxs mt-3">Drag and drop your image here or </p>
            <button class="text-white bg-cyan-600 active:bg-cyan-600 font-medium border border-transparent px-5 py-2 h-8 w-28 rounded mx-auto mb-6 mt-4 text-sm" @click="open">Choose File</button>
      </div>
    </div>
  </div>
</template>

<script>
import { useDropzone } from "vue3-dropzone";
import axios from "axios";

export default {
  name: "UseDropzone",
  setup() {
    const url = "/category-images"; // Your url on the server side
    const saveFiles = (files) => {
      const formData = new FormData(); // pass data as a form
      for (var x = 0; x < files.length; x++) {
        // append files as array to the form, feel free to change the array name
        formData.append("files[]", files[x]);
      }

      // post the formData to your backend where storage is processed. In the backend, you will need to loop through the array and save each file through the loop.

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.info(response.data);
        })
        .catch((err) => {
          console.error(err);
        });
    };

    function onDrop(acceptFiles, rejectReasons) {
      saveFiles(acceptFiles); // saveFiles as callback
      console.log(rejectReasons);
    }

    const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop });

    return {
      getRootProps,
      getInputProps,
      ...rest,
    };
  },
};
</script>
