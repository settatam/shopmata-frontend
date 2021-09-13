<template>
  <div class="bg-white w-6/10 p-8">
      <h1 class="text-lg font-semibold mb-4">General Information</h1>

      <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Product Name
          </label>
          <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
         <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
        </div>
        <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Product Description
          </label>
            <div class="quill border-gray-300 rounded-md">
                    <quill-editor
                    class="editor text-black"
                    ref="description"
                    theme="snow"
                    style="min-height: 158px"
                    :value="formFields.description"
                    :options="editorOption"
                    @change="onEditorChange"
                    @blur="onEditorBlur($event)"
                    @focus="onEditorFocus($event)"
                    @ready="onEditorReady($event)"
                    />
                        
            <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
            </div>
        </div>
        <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Meta Tag Title
          </label>
          <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
         <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
        </div>
        <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Meta Tag Description
          </label>
          <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
         <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
        </div>
        <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Meta Tag Keyword
          </label>
          <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
         <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
        </div>
        <div class=" required w-full mb-4">
          <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="products">
            Product Tag
          </label>
          <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
         <!--  <span v-if="v$.address.first_name.$error" class="text-red-400">{{v$.address.first_name.$errors[0].$message}}</span> -->
        </div>
  </div>
</template>

<script>
import hljs from "highlight.js";
import { ref } from "vue";

export default {
    data(){
        return{
            formFields:{
                description:''
            },
            editorOption: {
                modules: {
                toolbar: [
                    [{ color: [] }, { background: [] }],
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    ["link", "image", "video"],
                    ["clean"],
                ],
                syntax: {
                    highlight: (text) => hljs.highlightAuto(text).value,
                },
                },
            },
        }
    },
    computed:{
         editor() {
      return this.$refs.description?.quill;
    },
    editorContent() {
      return this.$refs.description.$refs.editor.innerHTML;
    },
    },
    methods:{
        onEditorChange(editor) {
            console.log(editor.editor);
            // console.log(this.$refs.description.$refs.editor.innerHTML);
        },
        onEditorBlur(editor) {
        // console.log("editor blur!", editor);
        },
        onEditorFocus(editor) {
        // console.log("editor focus!", editor);
        },
        onEditorReady(editor) {
        // console.log("editor ready!", editor);
        },
    },
    setup() {
    const open = ref(false);
    return {
     
    };
  },
}
</script>

<style scoped>
.quill {
  display: flex;
  flex-direction: column;
}
</style>