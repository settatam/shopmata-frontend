<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                static
                class="fixed inset-0 flex z-40 lg:hidden"
                @close="sidebarOpen = false"
                :open="sidebarOpen"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    />
                </TransitionChild>
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <div
                        class="
                            relative
                            flex-1 flex flex-col
                            max-w-xs
                            w-full
                            pt-5
                            pb-4
                            bg-cyan-700
                        "
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    class="
                                        ml-1
                                        flex
                                        items-center
                                        justify-center
                                        h-10
                                        w-10
                                        rounded-full
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-inset
                                        focus:ring-white
                                    "
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <img
                                class="h-8 w-auto"
                                src="https://fashionerize.nyc3.cdn.digitaloceanspaces.com/shopmata/shopmata-logo.png"
                                alt="Shopmata Logo"
                            />
                        </div>
                        <nav
                            class="mt-5 flex-shrink-0 h-full overflow-y-auto"
                            aria-label="Sidebar"
                        >
                            <template v-for="item in navigation" :key="item.name">
                            <div v-if="!item.children">
                                <inertia-link
                                    :href="item.href"
                                    :class="[
                                        isRoute(item.name)
                                            ? 'bg-cyan-800 text-white'
                                            : 'text-cyan-100 hover:text-white hover:bg-cyan-600',
                                        'group w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="
                                            mr-4
                                            flex-shrink-0
                                            h-6
                                            w-6
                                            text-cyan-200"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </inertia-link>
                            </div>
                            <Disclosure
                                as="div"
                                v-else
                                class="space-y-1"
                                v-slot="{ open }"
                            >
                                <DisclosureButton
                                    :class="[
                                        item.current
                                            ? 'bg-cyan-800 text-white'
                                            : 'text-cyan-100 hover:text-white hover:bg-cyan-600',
                                        'group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="
                                            mr-4
                                            flex-shrink-0
                                            h-6
                                            w-6
                                            text-cyan-200
                                        "
                                        aria-hidden="true"
                                    />
                                    <span class="flex-1">
                                        {{ item.name }}
                                    </span>
                                    <svg
                                        :class="[
                                            open
                                                ? 'text-cyan-400 rotate-90'
                                                : 'text-cyan-300',
                                            'ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-cyan-400 transition-colors ease-in-out duration-150',
                                        ]"
                                        viewBox="0 0 20 20"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M6 6L14 10L6 14V6Z"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </DisclosureButton>
                                <DisclosurePanel class="space-y-1">
                                    <inertia-link
                                        v-for="subItem in item.children"
                                        :key="subItem.name"
                                        :href="subItem.href"
                                        class="
                                            group
                                            w-full
                                            flex
                                            items-center
                                            pl-11
                                            pr-2
                                            py-2
                                            text-sm
                                            font-medium
                                            text-white
                                            rounded-md
                                            hover:text-gray-900 hover:bg-gray-50
                                        "
                                    >
                                        {{ subItem.name }}
                                    </inertia-link>
                                    <!-- <a v-for="subItem in item.children" :key="subItem.name" :href="subItem.href" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-white rounded-md hover:text-gray-900 hover:bg-gray-50">
                  {{ subItem.name }}
                </a> -->
                                </DisclosurePanel>
                            </Disclosure>
                        </template>
                            <div>
                                <div class="px-2 space-y-1">
                                    <inertia-link
                                        v-for="item in secondaryNavigation"
                                        :key="item.name"
                                        :href="item.href"
                                        class="
                                            group
                                            flex
                                            items-center
                                            px-
                                            py-2
                                            text-base
                                            font-medium
                                            rounded-md
                                            text-cyan-100
                                            hover:text-white hover:bg-cyan-600
                                        "
                                    >
                                        <component
                                            :is="item.icon"
                                            class="mr-4 h-6 w-6 text-cyan-200"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </inertia-link>
                                </div>
                            </div>
                        </nav>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-48">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div
                    class="
                        flex flex-col flex-grow
                        bg-cyan-700
                        pt-5
                        pb-4
                        overflow-y-auto
                    "
                >
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img
                            class="h-8 w-auto"
                            src="https://fashionerize.nyc3.cdn.digitaloceanspaces.com/shopmata/shopmata-logo.png"
                            alt="Shopmata Logo"
                        />
                    </div>
                    <nav
                        class="mt-5 flex-1 flex flex-col overflow-y-auto"
                        aria-label="Sidebar"
                    >
                        <template v-for="item in navigation" :key="item.name">
                            <div v-if="!item.children">
                                <inertia-link
                                    :href="item.href"
                                    :class="[
                                        isRoute(item.name)
                                            ? 'bg-cyan-800 text-white'
                                            : 'text-cyan-100 hover:text-white hover:bg-cyan-600',
                                        'group w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="
                                            mr-4
                                            flex-shrink-0
                                            h-6
                                            w-6
                                            text-cyan-200
                                        "
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </inertia-link>
                            </div>
                            <Disclosure
                                as="div"
                                v-else
                                class="space-y-1"
                                v-slot="{ open }"
                            >
                                <DisclosureButton
                                    :class="[
                                        item.current
                                            ? 'bg-cyan-800 text-white'
                                            : 'text-cyan-100 hover:text-white hover:bg-cyan-600',
                                        'group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="
                                            mr-4
                                            flex-shrink-0
                                            h-6
                                            w-6
                                            text-cyan-200
                                        "
                                        aria-hidden="true"
                                    />
                                    <span class="flex-1">
                                        {{ item.name }}
                                    </span>
                                    <svg
                                        :class="[
                                            open
                                                ? 'text-cyan-400 rotate-90'
                                                : 'text-cyan-300',
                                            'ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-cyan-400 transition-colors ease-in-out duration-150',
                                        ]"
                                        viewBox="0 0 20 20"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M6 6L14 10L6 14V6Z"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </DisclosureButton>
                                <DisclosurePanel class="space-y-1">
                                    <inertia-link
                                        v-for="subItem in item.children"
                                        :key="subItem.name"
                                        :href="subItem.href"
                                        class="
                                            group
                                            w-full
                                            flex
                                            items-center
                                            pl-11
                                            pr-2
                                            py-2
                                            text-sm
                                            font-medium
                                            text-white
                                            rounded-md
                                            hover:text-gray-900 hover:bg-gray-50
                                        "
                                    >
                                        {{ subItem.name }}
                                    </inertia-link>
                                    <!-- <a v-for="subItem in item.children" :key="subItem.name" :href="subItem.href" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-white rounded-md hover:text-gray-900 hover:bg-gray-50">
                  {{ subItem.name }}
                </a> -->
                                </DisclosurePanel>
                            </Disclosure>
                        </template>
                        <div class="mt-6 pt-6">
                            <div class="px-2 space-y-1">
                                <inertia-link
                                    v-for="item in secondaryNavigation"
                                    :key="item.name"
                                    :href="item.href"
                                    class="
                                        group
                                        flex
                                        items-center
                                        px-
                                        py-2
                                        text-sm
                                        leading-6
                                        font-medium
                                        rounded-md
                                        text-cyan-100
                                        hover:text-white hover:bg-cyan-600
                                    "
                                >
                                    <component
                                        :is="item.icon"
                                        class="mr-4 h-6 w-6 text-cyan-200"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </inertia-link>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-auto focus:outline-none">
            <div
                class="
                    relative
                    z-10
                    flex-shrink-0 flex
                    h-16
                    bg-white
                    border-b border-gray-200
                    lg:border-none
                "
            >
                <button
                    class="
                        px-4
                        border-r border-gray-200
                        text-gray-400
                        focus:outline-none
                        focus:ring-2
                        focus:ring-inset
                        focus:ring-cyan-500
                        lg:hidden
                    "
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt1Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <!-- Search bar -->
                <div
                    class="
                        flex-1
                        px-4
                        flex
                        justify-between
                        sm:px-6
                        lg:mx-auto lg:px-8
                    "
                >
                    <div class="flex-1 flex">
                        <form
                            class="w-full flex md:ml-0"
                            action="#"
                            method="GET"
                        >
                            <label for="search-field" class="sr-only"
                                >Search</label
                            >
                            <div
                                class="
                                    relative
                                    w-full
                                    text-gray-400
                                    focus-within:text-gray-600
                                "
                            >
                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        left-0
                                        flex
                                        items-center
                                        pointer-events-none
                                    "
                                    aria-hidden="true"
                                >
                                    <SearchIcon
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </div>
                                <input
                                    id="search-field"
                                    name="search-field"
                                    class="
                                        block
                                        w-full
                                        h-full
                                        pl-8
                                        pr-3
                                        py-2
                                        border-transparent
                                        text-gray-900
                                        placeholder-gray-500
                                        focus:outline-none
                                        focus:ring-0
                                        focus:border-transparent
                                        sm:text-sm
                                    "
                                    placeholder="search for products, customers, orders............."
                                    type="search"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button
                            class="
                                bg-white
                                p-1
                                rounded-full
                                text-gray-400
                                hover:text-gray-500
                                focus:outline-none
                                focus:ring-2
                                focus:ring-offset-2
                                focus:ring-cyan-500
                            "
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="ml-3 relative">
                            <div>
                                <MenuButton
                                    class="
                                        max-w-xs
                                        bg-white
                                        rounded-full
                                        flex
                                        items-center
                                        text-sm
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-offset-2
                                        focus:ring-cyan-500
                                        lg:p-2 lg:rounded-md lg:hover:bg-gray-50
                                    "
                                >
                                    <p
                                        class="
                                            h-10
                                            w-10
                                            rounded-full
                                            capitalize
                                            bg-blue-400
                                            text-white text-center text-sm
                                            py-2.5
                                            font-semibold
                                            mr-4
                                        "
                                    >
                                        {{
                                            $page.props?.user?.first_name.charAt(
                                                0
                                            )
                                        }}{{
                                            $page.props?.user?.last_name.charAt(
                                                0
                                            )
                                        }}
                                    </p>
                                    <!--  <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span>{{$page.props.user.first_name}} {{$page.props.user.first_name}}</span> -->
                                    <ChevronDownIcon
                                        class="
                                            hidden
                                            flex-shrink-0
                                            ml-1
                                            h-5
                                            w-5
                                            text-black
                                            font-extrabold
                                            lg:block
                                        "
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
                                        origin-top-right
                                        absolute
                                        right-0
                                        mt-2
                                        w-48
                                        rounded-md
                                        shadow-lg
                                        py-1
                                        bg-white
                                        ring-1 ring-black ring-opacity-5
                                        focus:outline-none
                                    "
                                >
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            href="#"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >Your Profile</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            href="#"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >Settings</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="doLogout"
                                            href="#"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >Logout</a
                                        >
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
            <footer class="grid grid-cols-2 gap-2 my-4 w-full md:grid-cols-5">
                <div class="px-4">
                    <p> This is the path for the footer </p>
                </div>
            </footer>

            <!-- End Page Content -->
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
} from "@headlessui/vue";
import {
    BellIcon,
    InboxIcon,
    ChartPieIcon,
    CogIcon,
    CreditCardIcon,
    DocumentReportIcon,
    ClipboardListIcon,
    HomeIcon,
    MenuAlt1Icon,
    QuestionMarkCircleIcon,
    ScaleIcon,
    ShieldCheckIcon,
    UserGroupIcon,
    XIcon,
    ShoppingBagIcon,
    ChartBarIcon,
    OfficeBuildingIcon,
    CashIcon,
} from "@heroicons/vue/outline";
import {
    CheckCircleIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    SearchIcon,
} from "@heroicons/vue/solid";

const secondaryNavigation = [
    { name: "Settings", href: "/admin/settings", icon: CogIcon },
];

const cards = [
    {
        name: "Account balance",
        href: "#",
        icon: ScaleIcon,
        amount: "$30,659.45",
    },
    // More items...
];
const transactions = [
    {
        id: 1,
        name: "Payment to Molly Sanders",
        href: "#",
        amount: "$20,000",
        currency: "USD",
        status: "success",
        date: "July 11, 2020",
        datetime: "2020-07-11",
    },
];
const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};

export default {
    props: {
       navigation: Array,
    },
    emits: [],
    components: {
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
        BellIcon,
        CashIcon,
        CheckCircleIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        MenuAlt1Icon,
        OfficeBuildingIcon,
        SearchIcon,
        XIcon,
        ChartBarIcon,
        Disclosure,
        DisclosurePanel,
        DisclosureButton,
        ChartPieIcon,
        ClipboardListIcon,
        HomeIcon,
        ShoppingBagIcon,
        InboxIcon,
        DocumentReportIcon,
        UserGroupIcon
    },
    setup(props) {
        const sidebarOpen = ref(false);
        const open = ref(false);

        function doLogout() {
            Inertia.post("/logout");
        }

        return {
            secondaryNavigation,
            cards,
            transactions,
            statusStyles,
            sidebarOpen,
            doLogout,
        };
    },
    methods: {
        isRoute(name) {
            return name.toLowerCase() === this.route().current();
        },
    },
};
</script>
