<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Store;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            //
            'appName' => config('app.name'),
            'store' => Store::find(session()->get('store_id')),
            'navigation' => [
                 [
                    'name' => 'Dashboard',
                    'icon' => 'HomeIcon',
                     'href' => '/admin/dashboard',
                     'current' => true
                ],
//                [
//                    'name' => 'Orders',
//                    'icon' => 'ShoppingBagIcon',
//                    'href' => '/admin/orders',
//                    'current' => false,
//                ],
//                [
//                    'name' => 'Products',
//                    'icon' => 'ChartPieIcon',
//                    'href' => '/admin/products',
//                    'current' => false,
//                    'children' => [
//                        [
//                            'name' => 'All Products',
//                            'href' => '/admin/products'
//                        ],
//                        [
//                            'name' => 'New Product',
//                            'href' => '/admin/products/create'
//                        ],
//                        [
//                            'name' => 'All Collections',
//                            'href' => '/admin/categories'
//                        ],
//                        [
//                            'name' => 'New Collection',
//                            'href' => '/admin/categories/create'
//                        ],
//                    ],
//                ],
                [
                    'name' => 'Customers',
                    'icon' => 'UserGroupIcon',
                    'href' => '/admin/customers',
                    'current' => false
                ],
                [
                    'name' => 'Messages',
                    'icon' => 'InboxIcon',
                    'href' => '/admin/messages',
                    'current' => false
                ],
                [
                    'name' => 'Transactions',
                    'icon' => 'ClipboardListIcon',
                    'href' => '/admin/transactions',
                    'current' => false
                ],
                [
                    'name' => 'Reports',
                    'icon' => 'DocumentReportIcon',
                    'href' => '/admin/reports',
                    'current' => false,
                ],
//                [
//                    'name' => 'Analytics',
//                    'icon' => 'ChartBarIcon',
//                    'href' => '/admin/analytics',
//                    'current' => false
//                ],
//                [
//                    'name' => 'Discounts',
//                    'icon' => 'CashIcon',
//                    'href' => '/admin/discounts',
//                    'current' => false
//                ],
                [
                    'name' => 'Online Store',
                    'icon' => 'OfficeBuildingIcon',
                    'href' => '/admin/online-store',
                    'current' => false,
                    'children' => [
                        [
                            'name' => 'My Themes',
                            'href' => 'admin/online-store/themes'
                        ],
                        [
                            'name' => 'Pages',
                            'href' => '/admin/store/pages',
                        ],
                        [
                            'name' => 'Navigation',
                            'href' => '/admin/online-store/navigation',
                        ],
                        [
                            'name' => 'Preferences',
                            'href' => '/admin/store/preferences'
                        ]
                    ]
                ],
            ]
        ]);
    }
}

