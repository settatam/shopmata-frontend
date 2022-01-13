<template>
  <!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK -->
  <app-layout>
    <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
      <!-- Breadcrumb -->
      <nav
        aria-label="Breadcrumb"
        class="bg-white border-b border-blue-gray-200 xl:hidden"
      >
        <div
          class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8"
        >
          <inertia-link
            href="#"
            class="
              -ml-1
              inline-flex
              items-center
              space-x-3
              text-sm
              font-medium
              text-gray-900
            "
          >
            <ChevronLeftIcon
              class="h-5 w-5 text-blue-gray-400"
              aria-hidden="true"
            />
            <span>Settings</span>
          </inertia-link>
        </div>
      </nav>
      <div
        class="
          overflow-auto
          border-gray-100
          flex flex-col
          lg:flex-row
          justify-center
          lg:justify-between
          pl-4
          pr-4
          lg:pr-8
          pt-8
          lg:pt-16
        "
      >
        <p class="text-2xl text-cyan-700 text-center lg:text-left mb-2 lg:mb-0">
          My Themes
        </p>
        <div class="flex items-center justify-between">
          <p class="mr-4 lg:mr-9">
            <i class="fas fa-eye mr-2"></i>View your Store
          </p>
          <p class="px-3 lg:px-9 bg-cyan-700 text-white py-3">
            Theme Marketplace
          </p>
        </div>
      </div>
      <div class="bg-white my-8 px-10 pt-7 pb-10">
        <div class="flex items-center mb-3">
          <p class="font-semibold text-xl mr-7">Current Theme</p>
          <i class="far fa-question-circle"></i>
        </div>
        <p class="mb-5 text-gray-500">
          This is the theme customers see when they visit your store.
        </p>
        <div class="flex flex-col lg:flex-row">
          <img
            src="../../../assets/placeholder_theme.jpg"
            alt="placeholder theme"
          />
          <div class="flex flex-col ml-2 lg:ml-11">
            <div class="flex mb-4 items-baseline">
              <p class="font-semibold text-xl mr-5">Cornerstore Beam</p>
              <p class="text-gray-500">Includes 3 styles</p>
            </div>
            <p class="text-gray-500 mb-4">
              Showcase your brand and products with Cornerstone Beam, our
              signature theme
            </p>
            <p class="text-gray-500 mb-4">Version 1.1.0</p>
            <p class="text-gray-500 mb-8">
              Developed and supported by ShopMata
            </p>
            <div class="flex">
              <inertia-link href="/online-store/code-editor">
                <button
                  class="
                    bg-cyan-700
                    text-white
                    py-4
                    px-11
                    font-semibold
                    text-sm
                    mr-4
                    focus:outline-none
                  "
                >
                  <span class="font-semibold">Customize</span>
                </button>
              </inertia-link>
              <!-- <button class="border border-purple-darker py-4 px-5  text-sm align-bottom focus:outline-none text-purple-darker" @click="toggleOpen()"> <span class="mr-5 font-semibold">Actions</span> <i class="fas fa-chevron-down"></i></button> -->
              <Menu as="div" class="relative inline-block text-left">
                <div>
                  <MenuButton
                    class="
                      inline-flex
                      justify-center
                      w-full
                      border border-gray-300
                      shadow-sm
                      px-6
                      py-4
                      bg-white
                      text-sm
                      font-medium
                      text-gray-700
                      focus:outline-none
                    "
                  >
                    Actions
                    <ChevronDownIcon
                      class="-mr-1 ml-2 h-5 w-5"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="
                      origin-top-left
                      absolute
                      left-0
                      mt-2
                      w-44
                      lg:w-56
                      rounded-md
                      shadow-lg
                      bg-white
                      focus:outline-none
                    "
                  >
                    <div class="py-1">
                      <MenuItem v-slot="{ active }">
                        <a
                          href="#"
                          :class="[
                            active
                              ? 'bg-gray-100 text-gray-900'
                              : 'text-gray-700',
                            'block px-4 py-2 text-sm',
                          ]"
                          >Preview</a
                        >
                      </MenuItem>
                      <MenuItem v-slot="{ active }">
                        <a
                          href="#"
                          :class="[
                            active
                              ? 'bg-gray-100 text-gray-900'
                              : 'text-gray-700',
                            'block px-4 py-2 text-sm',
                          ]"
                          >Rename</a
                        >
                      </MenuItem>
                      <MenuItem v-slot="{ active }">
                        <a
                          href="#"
                          :class="[
                            active
                              ? 'bg-gray-100 text-gray-900'
                              : 'text-gray-700',
                            'block px-4 py-2 text-sm',
                          ]"
                          >Themes Details</a
                        >
                      </MenuItem>
                      <MenuItem v-slot="{ active }">
                        <a
                          href="#"
                          :class="[
                            active
                              ? 'bg-gray-100 text-gray-900'
                              : 'text-gray-700',
                            'block px-4 py-2 text-sm',
                          ]"
                          >Download Themes</a
                        >
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white px-10 pt-7 pb-8">
        <p class="font-semibold text-xl mr-7">My Themes</p>
        <p class="text-gray-500">
          Manage and store all your published themes. This includes the
          collections of your active and inactive themes.
        </p>
        <div class="flex flex-col lg:flex-row">
          <div>
            <div class="flex flex-col border border-gray-300 lg:w-72 mt-7">
              <img
                src="../../../assets/placeholder_theme2.jpg"
                alt="my theme placeholder"
              />
              <p class="mt-2 font-semibold pl-4">Cornerstore Beam</p>
              <div class="flex flex-row justify-between items-center pl-4">
                <p class="text-xs text-gray-500">Version 1.1.0</p>
                <button class="focus:outline-none">
                  <!-- @change for the toggle btn -->

                  <Switch
                    v-model="enabled"
                    :class="[
                      enabled ? 'bg-cyan-700' : 'bg-gray-200',
                      'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none',
                    ]"
                  >
                    <span class="sr-only">Use setting</span>
                    <span
                      aria-hidden="true"
                      :class="[
                        enabled ? 'translate-x-5' : 'translate-x-0',
                        'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                      ]"
                    />
                  </Switch>
                </button>
              </div>
            </div>
          </div>
          <div class="lg:ml-4">
            <div class="flex flex-col border border-gray-300 lg:w-72 mt-7">
              <img
                src="../../../assets/placeholder_theme2.jpg"
                alt="my theme placeholder"
              />
              <p class="mt-2 font-semibold pl-4">Cornerstore Beam</p>
              <div class="flex flex-row justify-between items-center pl-4">
                <p class="text-xs text-gray-500">Version 1.1.0</p>
                <!-- active and inactive -->
                <button class="focus:outline-none">
                  <!-- @change for the toggle btn -->
                  <Switch
                    v-model="enabled1"
                    :class="[
                      enabled1 ? 'bg-cyan-700' : 'bg-gray-200',
                      'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none',
                    ]"
                  >
                    <span class="sr-only">Use setting</span>
                    <span
                      aria-hidden="true"
                      :class="[
                        enabled1 ? 'translate-x-5' : 'translate-x-0',
                        'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                      ]"
                    />
                  </Switch>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import { ref } from "vue";
import axios from "axios";
import AppLayout from "../../Layouts/AppLayout.vue";
import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { ChevronLeftIcon, ChevronDownIcon } from "@heroicons/vue/solid";
import Alert from "../../Components/Alert.vue";
import { Switch } from "@headlessui/vue";

export default {
  components: {
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    ChevronLeftIcon,
    Alert,
    Switch,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    ChevronDownIcon,
  },
  setup() {
    const enabled = ref(false);
    const enabled1 = ref(false);

    return {
      enabled,
      enabled1,
    };
  },
};
</script>