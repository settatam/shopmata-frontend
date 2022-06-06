<template>
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <TransitionRoot as="template" :show="open">
    <Dialog
      as="div"
      static
      class="fixed z-10 inset-0 overflow-y-auto"
      @close="open = false"
      :open="open"
    >
      <div
        class="
          flex
          items-end
          justify-center
          min-h-screen
          pt-4
          px-4
          pb-20
          text-center
          sm:block
          sm:p-0
        "
      >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <DialogOverlay
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-200"
          leave-from="opacity-100 translate-y-0 sm:scale-100"
          leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            class="
              inline-block
              align-bottom
              bg-white
              rounded-lg
              px-4
              pt-5
              pb-4
              text-left
              overflow-hidden
              shadow-xl
              transform
              transition-all
              sm:my-8
              sm:align-middle
              sm:max-w-lg
              sm:w-full
              sm:p-6
            "
          >
            <div>
              <div class="mx-auto flex items-center justify-center">
                <h3 class="font-semibold text-2xl pb-5">
                  Add a new {{ this.text }}
                </h3>
              </div>
              <div class="mt-3 text-center sm:mt-5">
                <div
                  class="flex justify-between mb-8 py-1.5 bg-gray-100 -mx-6"
                  v-if="
                    this.text == 'layout' ||
                    this.text == 'template' ||
                    this.text == 'asset'
                  "
                >
                  <p
                    class="
                      lg:mr-4
                      text-base
                      lg:text-lg
                      text-center
                      my-auto
                      lg:ml-11
                      ml-5
                      py-2
                      w-4.5/10
                    "
                    :class="activeUpload ? 'text-black bg-white' : ''"
                    @click="toggleBtn"
                  >
                    Upload a file
                  </p>
                  <a
                    class="
                      lg:mr-11
                      mr-5
                      text-base
                      lg:text-lg
                      text-center
                      my-auto
                      ml-4
                      py-2
                      w-4.5/10
                      cursor-pointer
                    "
                    :class="activeBlank ? 'text-black bg-white' : ''"
                    @click="toggleBtn"
                  >
                    Create a blank file
                  </a>
                </div>

                <div v-if="activeUpload">
                  <div
                    class="flex ml-4"
                    v-if="
                      this.text == 'layout' ||
                      this.text == 'template' ||
                      this.text == 'asset'
                    "
                  >
                    <label
                      for="file-upload"
                      class="custom-file-upload mr-5 mb-7"
                      @click="filecount"
                      >Choose a file</label
                    >
                    <input id="file-upload" ref="file" type="file"  @change="doFileUpload($event)"/><span
                      class="mt-2"
                      v-if="this.count == 0"
                    >
                      No file chosen</span
                    >
                    <span class="mt-2" v-else-if="this.count == 1"
                      >{{ this.count }} file chosen </span
                    ><span class="mt-2" v-else>
                      {{ this.count }} files chosen
                    </span>
                  </div>
                </div>
                <div v-if="activeBlank">
                  <div
                    class="flex flex-col lg:flex-row justify-around mb-8"
                    v-if="this.text == 'layout' || this.text == 'template'"
                  >
                    <p class="my-auto">File Name</p>
                    <input
                      type="text"
                      name="asset"
                      id=""
                      class="
                        border border-gray-500
                        h-10
                        focus:outline-none
                        pl-3
                      "
                      v-model="creatingContent.title"
                    />
                    <select
                      name="asset"
                      id=""
                      class="
                        border border-gray-500
                        pl-4
                        pr-8
                        my-auto
                        h-10
                        focus:outline-none
                      "
                      v-model="selected"
                    >
                      <option value=".twig">twig</option>
                      <option value=".css">CSS</option>
                      <option value=".js">JS</option>
                      <option value=".html">HTML</option>
                    </select>
                  </div>
                  <div
                    class="flex flex-col lg:flex-row justify-around mb-8"
                    v-if="this.text == 'asset'"
                  >
                    <p class="my-auto">File Name</p>
                    <input
                      type="text"
                      name="asset"
                      id=""
                      class="
                        border border-gray-500
                        h-10
                        focus:outline-none
                        pl-3
                      "
                      v-model="creatingContent.title"
                    />
                    <select
                      name="asset"
                      id=""
                      class="
                        border border-gray-500
                        px-4
                        my-auto
                        h-10
                        focus:outline-none
                      "
                      v-model="selected"
                    >
                      <option value=".twig">twig</option>
                      <option value=".css.twig">CSS.twig</option>
                      <option value=".js.twig">JS.twig</option>
                      <option value=".css">CSS</option>
                      <option value=".js">JS</option>
                    </select>
                  </div>
                </div>

                <div class="flex justify-between" v-if="this.text == 'snippet'">
                  <label for="snippet" class="text-lg mt-2 w-1/2"
                    >File Name</label
                  >
                  <input
                    type="text"
                    name="snippet"
                    id=""
                    class="
                      h-10
                      w-1/2
                      border border-gray-400
                      mb-9
                      focus:outline-none
                    "
                    v-model="creatingContent.title"
                    @blur="removeExtension()"
                  />
                </div>
                <div class="border-t border-gray-200 -mx-6"></div>
              </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              <button
                type="button"
                class="
                  w-full
                  inline-flex
                  justify-center
                  rounded-md
                  border border-transparent
                  shadow-sm
                  px-4
                  py-2
                  bg-cyan-700
                  text-base
                  font-medium
                  text-white
                  focus:outline-none
                  sm:ml-3
                  sm:w-auto
                  sm:text-sm
                "
                @click="upload()"
              >
                <i
                  class="fas fa-spinner fa-pulse text-white m-2"
                  v-if="loading"
                ></i>
                {{ this.text }}
              </button>
              <button
                type="button"
                class="
                  mt-3
                  w-full
                  inline-flex
                  justify-center
                  rounded-md
                  border border-gray-300
                  shadow-sm
                  px-4
                  py-2
                  bg-white
                  text-base
                  font-medium
                  text-gray-700
                  hover:bg-gray-50
                  focus:outline-none
                  sm:mt-0
                  sm:w-auto
                  sm:text-sm
                "
                @click="close()"
                ref="cancelButtonRef"
              >
                Cancel
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from "vue";
import {
  Dialog,
  DialogOverlay,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon } from "@heroicons/vue/outline";

export default {
  props: ["text", "creatingContent", "loading"],
  emits: ["close", "createFile", "uploadFile"],
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    CheckIcon,
  },
  data() {
    return {
      count: 0,
      activeUpload: true,
      activeBlank: false,
      selected: ".twig",
    };
  },
  computed: {},
  methods: {
    placeholder() {
      this.file = "";
    },
    addOption: function () {
      this.creatingContent.title = this.creatingContent.title + this.selected;
    },

      filecount() {
      let fi = document.getElementById("file-upload");
      if (fi.files.length < 0) {
        this.count = 0;
      } else {
        console.log(this.count);
      }
    },
    toggleBtn() {
      if (this.activeUpload == false) {
        this.activeUpload = true;
        this.activeBlank = false;
      } else if (this.activeBlank == false) {
        this.activeBlank = true;
        this.activeUpload = false;
      }
    },
    upload() {
      this.addOption();
      this.$emit("createFile");
      this.open = false;
    },
    close() {
      this.$emit("close");
      this.open = false;
    },
    removeExtension() {
      /* Remove whitespace? */
      this.selected = "";
    },
  },
  setup(props, {emit}) {
    const open = ref(true);

    const doFileUpload = (event) => {
        emit('uploadFile', event.target.files[0], true);
        open.value = false;
    }

    return {
        open,
        doFileUpload
    };
  },
};
</script>

<style>
input[type="file"] {
  display: none;
}
.custom-file-upload {
  border: 1px solid #8a8a99;
  display: inline-block;
  font-weight: 600;
  padding: 6px 18px;
  cursor: pointer;
}
</style>
