<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div>
            <!-- 3 column wrapper -->
            <div class="flex-grow w-full mx-auto xl:px-8 lg:flex">
                <!-- Left sidebar & main wrapper -->
                <div class="flex-1 min-w-0 xl:flex flex-col pr-5">
                    <div>
                        <h1
                            class="text-2xl leading-6 font-medium text-gray-900 my-5"
                        >
                            Transaction Summary
                        </h1>
                        <div
                            class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            <!-- Card -->
                            <div
                                v-for="card in cards"
                                :key="card.name"
                                class="bg-white overflow-hidden shadow rounded-lg"
                            >
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <component
                                                :is="card.icon"
                                                class="h-6 w-6 text-gray-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt
                                                    class="text-xs font-medium text-gray-500 truncate uppercase tracking-wide"
                                                >
                                                    {{ card.name }}
                                                </dt>
                                                <dd>
                                                    <div
                                                        class="text-lg font-medium text-gray-900"
                                                    >
                                                        {{ card.amount }}
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-5 py-3">
                                    <div class="text-sm">
                                        <a
                                            :href="card.href"
                                            class="font-medium text-cyan-700 hover:text-cyan-900"
                                        >
                                            View all
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Projects List -->
                    <div class="lg:min-w-0 lg:flex-1 mb-5">
                        <div
                            class="shadow bg-white overflow-hidden sm:rounded-md mt-5"
                        >
                        </div>
                    </div>
                    <div class="bg-white lg:min-w-0 lg:flex-1">
                        <ul
                            role="list"
                            class="relative z-0 divide-y divide-gray-200 border-b border-gray-200"
                        >
                            <li
                                v-for="project in projects"
                                :key="project.repo"
                                class="relative pl-4 pr-6 py-5 hover:bg-gray-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6"
                            >
                                <div
                                    class="flex items-center justify-between space-x-4"
                                >
                                    <!-- Repo name and link -->
                                    <div class="min-w-0 space-y-3">
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <span
                                                :class="[
                                                    project.active
                                                        ? 'bg-green-100'
                                                        : 'bg-gray-100',
                                                    'h-4 w-4 rounded-full flex items-center justify-center'
                                                ]"
                                                aria-hidden="true"
                                            >
                                                <span
                                                    :class="[
                                                        project.active
                                                            ? 'bg-green-400'
                                                            : 'bg-gray-400',
                                                        'h-2 w-2 rounded-full'
                                                    ]"
                                                />
                                            </span>

                                            <span class="block">
                                                <h2 class="text-sm font-medium">
                                                    <a :href="project.href">
                                                        <span
                                                            class="absolute inset-0"
                                                            aria-hidden="true"
                                                        />
                                                        {{ project.name }}
                                                        <span class="sr-only">{{
                                                            project.active
                                                                ? 'Running'
                                                                : 'Not running'
                                                        }}</span>
                                                    </a>
                                                </h2>
                                            </span>
                                        </div>
                                        <a
                                            :href="project.repoHref"
                                            class="relative group flex items-center space-x-2.5"
                                        >
                                            <svg
                                                class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-gray-500"
                                                viewBox="0 0 18 18"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M8.99917 0C4.02996 0 0 4.02545 0 8.99143C0 12.9639 2.57853 16.3336 6.15489 17.5225C6.60518 17.6053 6.76927 17.3277 6.76927 17.0892C6.76927 16.8762 6.76153 16.3104 6.75711 15.5603C4.25372 16.1034 3.72553 14.3548 3.72553 14.3548C3.31612 13.316 2.72605 13.0395 2.72605 13.0395C1.9089 12.482 2.78793 12.4931 2.78793 12.4931C3.69127 12.5565 4.16643 13.4198 4.16643 13.4198C4.96921 14.7936 6.27312 14.3968 6.78584 14.1666C6.86761 13.5859 7.10022 13.1896 7.35713 12.965C5.35873 12.7381 3.25756 11.9665 3.25756 8.52116C3.25756 7.53978 3.6084 6.73667 4.18411 6.10854C4.09129 5.88114 3.78244 4.96654 4.27251 3.72904C4.27251 3.72904 5.02778 3.48728 6.74717 4.65082C7.46487 4.45101 8.23506 4.35165 9.00028 4.34779C9.76494 4.35165 10.5346 4.45101 11.2534 4.65082C12.9717 3.48728 13.7258 3.72904 13.7258 3.72904C14.217 4.96654 13.9082 5.88114 13.8159 6.10854C14.3927 6.73667 14.7408 7.53978 14.7408 8.52116C14.7408 11.9753 12.6363 12.7354 10.6318 12.9578C10.9545 13.2355 11.2423 13.7841 11.2423 14.6231C11.2423 15.8247 11.2313 16.7945 11.2313 17.0892C11.2313 17.3299 11.3937 17.6097 11.8501 17.522C15.4237 16.3303 18 12.9628 18 8.99143C18 4.02545 13.97 0 8.99917 0Z"
                                                    fill="currentcolor"
                                                />
                                            </svg>
                                            <span
                                                class="text-sm text-gray-500 group-hover:text-gray-900 font-medium truncate"
                                            >
                                                {{ project.repo }}
                                            </span>
                                        </a>
                                    </div>
                                    <div class="sm:hidden">
                                        <ChevronRightIcon
                                            class="h-5 w-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                    </div>
                                    <!-- Repo meta info -->
                                    <div
                                        class="hidden sm:flex flex-col flex-shrink-0 items-end space-y-3"
                                    >
                                        <p class="flex items-center space-x-4">
                                            <a
                                                :href="project.siteHref"
                                                class="relative text-sm text-gray-500 hover:text-gray-900 font-medium"
                                            >
                                                Visit site
                                            </a>
                                            <button
                                                type="button"
                                                class="relative bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >
                                                <span class="sr-only">{{
                                                    project.starred
                                                        ? 'Add to favorites'
                                                        : 'Remove from favorites'
                                                }}</span>
                                                <StarIcon
                                                    :class="[
                                                        project.starred
                                                            ? 'text-yellow-300 hover:text-yellow-400'
                                                            : 'text-gray-300 hover:text-gray-400',
                                                        'h-5 w-5'
                                                    ]"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </p>
                                        <p
                                            class="flex text-gray-500 text-sm space-x-2"
                                        >
                                            <span>{{ project.tech }}</span>
                                            <span aria-hidden="true"
                                                >&middot;</span
                                            >
                                            <span
                                                >Last deploy
                                                {{ project.lastDeploy }}</span
                                            >
                                            <span aria-hidden="true"
                                                >&middot;</span
                                            >
                                            <span>{{ project.location }}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Activity feed -->
                <div
                    class="bg-gray-50 pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0"
                >
                    <div class="pl-6 lg:w-96">
                        <div class="pt-6 pb-2">
                            <h2 class="text-sm font-semibold">Activity</h2>
                        </div>
                        <div>
                            <ul role="list" class="divide-y divide-gray-200">
                                <li
                                    v-for="item in activityItems"
                                    :key="item.commit"
                                    class="py-4"
                                >
                                    <div class="flex space-x-3">
                                        <img
                                            class="h-6 w-6 rounded-full"
                                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80"
                                            alt=""
                                        />
                                        <div class="flex-1 space-y-1">
                                            <div
                                                class="flex items-center justify-between"
                                            >
                                                <h3 class="text-sm font-medium">
                                                    You
                                                </h3>
                                                <p
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ item.time }}
                                                </p>
                                            </div>
                                            <p class="text-sm text-gray-500">
                                                Deployed {{ item.project }} ({{
                                                    item.commit
                                                }}
                                                in master) to
                                                {{ item.environment }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="py-4 text-sm border-t border-gray-200">
                                <a
                                    href="#"
                                    class="text-indigo-600 font-semibold hover:text-indigo-900"
                                    >View all activity
                                    <span aria-hidden="true">&rarr;</span></a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity list (smallest breakpoint only) -->
            <div class="shadow sm:hidden">
                <ul
                    class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden"
                >
                    <li
                        v-for="transaction in transactions"
                        :key="transaction.id"
                    >
                        <a
                            :href="transaction.href"
                            class="block px-4 py-4 bg-white hover:bg-gray-50"
                        >
                            <span class="flex items-center space-x-4">
                                <span class="flex-1 flex space-x-2 truncate">
                                    <CashIcon
                                        class="flex-shrink-0 h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                    <span
                                        class="flex flex-col text-gray-500 text-sm truncate"
                                    >
                                        <span class="truncate">{{
                                            transaction.name
                                        }}</span>
                                        <span
                                            ><span
                                                class="text-gray-900 font-medium"
                                                >{{ transaction.amount }}</span
                                            >
                                            {{ transaction.currency }}</span
                                        >
                                        <time
                                            :datetime="transaction.datetime"
                                            >{{ transaction.date }}</time
                                        >
                                    </span>
                                </span>
                                <ChevronRightIcon
                                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </span>
                        </a>
                    </li>
                </ul>

                <nav
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200"
                    aria-label="Pagination"
                >
                    <div class="flex-1 flex justify-between">
                        <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                        >
                            Previous
                        </a>
                        <a
                            href="#"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                        >
                            Next
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Activity table (small breakpoint and up) -->
            <div class="hidden sm:block">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col mt-2">
                        <div
                            class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from 'vue'
import AppLayout from '../Layouts/AppLayout.vue'
import axios from 'axios'

import {
    BadgeCheckIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    CollectionIcon,
    SearchIcon,
    SortAscendingIcon,
    StarIcon,
    ShoppingBagIcon
} from '@heroicons/vue/solid'

import { ScaleIcon } from '@heroicons/vue/outline'

const transactions = [
    {
        id: 1,
        name: 'Payment to Molly Sanders',
        href: '#',
        amount: '$20,000',
        currency: 'USD',
        status: 'success',
        date: 'July 11, 2020',
        datetime: '2020-07-11'
    },
    {
        id: 2,
        name: 'Payment to Molly Sanders',
        href: '#',
        amount: '$20,000',
        currency: 'USD',
        status: 'success',
        date: 'July 11, 2020',
        datetime: '2020-07-11'
    },
    {
        id: 3,
        name: 'Payment to Molly Sanders',
        href: '#',
        amount: '$20,000',
        currency: 'USD',
        status: 'success',
        date: 'July 11, 2020',
        datetime: '2020-07-11'
    }
    // More transactions...
]

const cards = [
    { name: 'Total Sales', href: '#', icon: ScaleIcon, amount: '$30,659.45' },
    { name: 'Sales Today', href: '#', icon: ScaleIcon, amount: '$30,659.45' },
    {
        name: 'Total Customers',
        href: '#',
        icon: ScaleIcon,
        amount: '$30,659.45'
    }
    // More items...
]

const projects = [
    {
        name: 'Workcation',
        href: '#',
        siteHref: '#',
        repoHref: '#',
        repo: 'debbielewis/workcation',
        tech: 'Laravel',
        lastDeploy: '3h ago',
        location: 'United states',
        starred: true,
        active: true
    }
    // More projects...
]

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

const activityItems = [
    {
        project: 'Workcation',
        commit: '2d89f0c8',
        environment: 'production',
        time: '1h'
    }
    // More items...
]

const applications = [
    {
        applicant: {
            name: 'Ricardo Cooper',
            email: 'ricardo.cooper@example.com',
            imageUrl:
                'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
        },
        date: '2020-01-07',
        dateFull: 'January 7, 2020',
        stage: 'Completed phone screening',
        href: '#'
    },
    {
        applicant: {
            name: 'Kristen Ramos',
            email: 'kristen.ramos@example.com',
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
        },
        date: '2020-01-07',
        dateFull: 'January 7, 2020',
        stage: 'Completed phone screening',
        href: '#'
    },
    {
        applicant: {
            name: 'Ted Fox',
            email: 'ted.fox@example.com',
            imageUrl:
                'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
        },
        date: '2020-01-07',
        dateFull: 'January 7, 2020',
        stage: 'Completed phone screening',
        href: '#'
    }
]
export default {
    components: {
        AppLayout,
        ScaleIcon,
        BadgeCheckIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        CollectionIcon,
        SearchIcon,
        SortAscendingIcon,
        ShoppingBagIcon,
        StarIcon
    },
    props: {
        notifications: Array,
        navigation: Array
    },
    data () {
        return {
            dashboard: {
                highRiskOrder: 0,
                ordersToFulfill: 0,
                paymentToCapture: 0,
                percentage: 0,
                todaySales: 0,
                totalSales: 0,
                graphData: {
                    months: [],
                    sales: []
                }
            }
        }
    },
    setup (props) {
        const open = ref(false)
        const notifications = props.notifications
        return {
            transactions,
            statusStyles,
            cards,
            activityItems,
            projects,
            applications
            // notifications
        }
    }
}
</script>
