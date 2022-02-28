<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_06_01_000001_create_oauth_auth_codes_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2016_06_01_000002_create_oauth_access_tokens_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2016_06_01_000003_create_oauth_refresh_tokens_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2016_06_01_000004_create_oauth_clients_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2016_06_01_000005_create_oauth_personal_access_clients_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2018_05_28_012819_create_carts_table',
                'batch' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2018_05_28_012918_create_orders_table',
                'batch' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2018_05_28_014642_create_payments_table',
                'batch' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2018_05_28_014916_create_payment_details_table',
                'batch' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2018_05_28_015321_create_shipping_addresses_table',
                'batch' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2018_06_02_234516_add_image_url_to_cart',
                'batch' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2018_06_03_014358_create_products_table',
                'batch' => 2,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2018_06_13_001627_add__zip_to_shipping_address',
                'batch' => 2,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2018_07_22_064010_add_user_id_to_shipping_address',
                'batch' => 2,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2018_09_12_001037_create_sells_table',
                'batch' => 2,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2018_09_12_032031_add_values_to_sells_table',
                'batch' => 2,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2018_09_16_232803_add_category_id_to_sells',
                'batch' => 2,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2018_09_16_233753_add_category_id_to_sell',
                'batch' => 2,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2018_10_23_232312_create_product_variants_table',
                'batch' => 2,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2018_10_25_050708_create_product_attributes_table',
                'batch' => 2,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2018_10_25_051053_create_product_images_table',
                'batch' => 2,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2018_10_18_105515_alter_users_table',
                'batch' => 3,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2018_10_19_173617_alter_table_users__add_store_user_name',
                'batch' => 3,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2018_10_19_185620_alter_users_table_add_phone_number',
                'batch' => 3,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2018_10_22_123756_alter_table_users_add_slug',
                'batch' => 3,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2018_10_27_010735_add_category_to_products_table',
                'batch' => 3,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2018_11_15_011546_add_merchant_id_to_products_page',
                'batch' => 4,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2018_11_15_011623_create_categories_table',
                'batch' => 4,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2018_11_15_011708_create_subcategories_table',
                'batch' => 4,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2018_11_15_145611_add_group_to_user_table',
                'batch' => 5,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2018_11_15_145643_add-merchant_id_to_orders_table',
                'batch' => 5,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2018_11_19_134147_create_accept_marketings_table',
                'batch' => 6,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2018_11_24_161621_remove_sku_from_prodct_images',
                'batch' => 6,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2018_11_24_194155_add_color_to_product_images',
                'batch' => 7,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2018_11_25_013955_add_weight_to_products_table',
                'batch' => 8,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2018_11_26_030722_add_product_id_to_product_attributes_table',
                'batch' => 9,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2018_12_29_011719_add_sku_to_product_images',
                'batch' => 10,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2019_01_13_002900_create_item_views_table',
                'batch' => 11,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2019_01_13_003513_create_item_ratings_table',
                'batch' => 11,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2019_01_20_050246_create_invoices_table',
                'batch' => 12,
            ),
            42 => 
            array (
                'id' => 43,
                'migration' => '2019_01_20_053556_add_invoice_id_to_carts_table',
                'batch' => 12,
            ),
            43 => 
            array (
                'id' => 44,
                'migration' => '2019_01_20_055932_create_designers_table',
                'batch' => 12,
            ),
            44 => 
            array (
                'id' => 45,
                'migration' => '2019_01_20_130922_create_quotes_table',
                'batch' => 13,
            ),
            45 => 
            array (
                'id' => 46,
                'migration' => '2019_01_20_131508_create_quote_activities_table',
                'batch' => 13,
            ),
            46 => 
            array (
                'id' => 47,
                'migration' => '2019_01_20_133929_create_sale_offers_table',
                'batch' => 13,
            ),
            47 => 
            array (
                'id' => 48,
                'migration' => '2019_01_21_041303_add_thumb_to_product_images',
                'batch' => 14,
            ),
            48 => 
            array (
                'id' => 49,
                'migration' => '2019_01_21_043259_add_quote_id_to_sells',
                'batch' => 15,
            ),
            49 => 
            array (
                'id' => 50,
                'migration' => '2019_02_07_114237_add_size_to',
                'batch' => 16,
            ),
            50 => 
            array (
                'id' => 51,
                'migration' => '2019_02_07_114732_add_quote_id_to_sell',
                'batch' => 17,
            ),
            51 => 
            array (
                'id' => 52,
                'migration' => '2019_02_07_222625_create_catalog_items',
                'batch' => 17,
            ),
            52 => 
            array (
                'id' => 53,
                'migration' => '2019_02_27_141502_add_discout_code_to_invoice',
                'batch' => 17,
            ),
            53 => 
            array (
                'id' => 54,
                'migration' => '2019_02_27_141851_add_discount_to_cart',
                'batch' => 17,
            ),
            54 => 
            array (
                'id' => 55,
                'migration' => '2019_02_27_142026_create_product_discounts_table',
                'batch' => 18,
            ),
            55 => 
            array (
                'id' => 56,
                'migration' => '2019_02_27_142131_create_discounts_table',
                'batch' => 18,
            ),
            56 => 
            array (
                'id' => 57,
                'migration' => '2019_02_27_164140_change_order_id_to_invoice_id',
                'batch' => 18,
            ),
            57 => 
            array (
                'id' => 58,
                'migration' => '2019_04_04_192907_create_analytics_table',
                'batch' => 19,
            ),
            58 => 
            array (
                'id' => 59,
                'migration' => '2019_04_04_230824_add_ip_address_to_analytics',
                'batch' => 19,
            ),
            59 => 
            array (
                'id' => 60,
                'migration' => '2019_04_04_232239_add_is_mobile_to_analytics',
                'batch' => 20,
            ),
            60 => 
            array (
                'id' => 61,
                'migration' => '2019_04_05_003630_add_merchant_id_to_analytics',
                'batch' => 21,
            ),
            61 => 
            array (
                'id' => 62,
                'migration' => '2019_04_05_172340_create_category_paths_table',
                'batch' => 22,
            ),
            62 => 
            array (
                'id' => 63,
                'migration' => '2019_04_05_172349_create_category_descriptions_table',
                'batch' => 22,
            ),
            63 => 
            array (
                'id' => 64,
                'migration' => '2019_04_05_174957_update_categories_table',
                'batch' => 22,
            ),
            64 => 
            array (
                'id' => 65,
                'migration' => '2019_04_11_054520_create_countries_table',
                'batch' => 22,
            ),
            65 => 
            array (
                'id' => 66,
                'migration' => '2019_04_11_054935_create_coupons_table',
                'batch' => 23,
            ),
            66 => 
            array (
                'id' => 67,
                'migration' => '2019_04_11_061420_create_coupon_categories_table',
                'batch' => 23,
            ),
            67 => 
            array (
                'id' => 68,
                'migration' => '2019_04_11_061606_create_coupon_products_table',
                'batch' => 23,
            ),
            68 => 
            array (
                'id' => 69,
                'migration' => '2019_04_11_061933_create_currencies_table',
                'batch' => 23,
            ),
            69 => 
            array (
                'id' => 70,
                'migration' => '2019_04_11_062029_create_coupon_histories_table',
                'batch' => 23,
            ),
            70 => 
            array (
                'id' => 71,
                'migration' => '2019_04_11_065442_create_seo_urls_table',
                'batch' => 24,
            ),
            71 => 
            array (
                'id' => 72,
                'migration' => '2019_04_12_002357_add_merchant_id_to_categories',
                'batch' => 24,
            ),
            72 => 
            array (
                'id' => 73,
                'migration' => '2019_04_12_003541_add_merchantsss_id_to_categories',
                'batch' => 25,
            ),
            73 => 
            array (
                'id' => 74,
                'migration' => '2019_04_17_223126_add_level_to_categories',
                'batch' => 26,
            ),
            74 => 
            array (
                'id' => 75,
                'migration' => '2019_04_17_230203_create_product_categories_table',
                'batch' => 27,
            ),
            75 => 
            array (
                'id' => 76,
                'migration' => '2019_04_17_233242_add_store_id_to_products',
                'batch' => 28,
            ),
            76 => 
            array (
                'id' => 77,
                'migration' => '2019_04_18_030027_add_store_id_to_categories',
                'batch' => 29,
            ),
            77 => 
            array (
                'id' => 78,
                'migration' => '2019_04_18_153348_add_slug_to_product',
                'batch' => 30,
            ),
            78 => 
            array (
                'id' => 79,
                'migration' => '2019_05_10_210040_add_type_to_user_table',
                'batch' => 31,
            ),
            79 => 
            array (
                'id' => 80,
                'migration' => '2019_04_12_150406_create_settings_table',
                'batch' => 32,
            ),
            80 => 
            array (
                'id' => 81,
                'migration' => '2019_04_13_064505_create_stores_table',
                'batch' => 32,
            ),
            81 => 
            array (
                'id' => 82,
                'migration' => '2019_04_13_065247_create_store_settings_table',
                'batch' => 32,
            ),
            82 => 
            array (
                'id' => 83,
                'migration' => '2019_05_17_002500_create_themes_table',
                'batch' => 32,
            ),
            83 => 
            array (
                'id' => 84,
                'migration' => '2019_05_17_003830_create_store_accounts_table',
                'batch' => 32,
            ),
            84 => 
            array (
                'id' => 85,
                'migration' => '2019_05_18_204627_update_products_table',
                'batch' => 33,
            ),
            85 => 
            array (
                'id' => 86,
                'migration' => '2019_05_22_024227_add_brand_id_to_products',
                'batch' => 34,
            ),
            86 => 
            array (
                'id' => 87,
                'migration' => '2019_05_22_025223_update_store_accounts',
                'batch' => 35,
            ),
            87 => 
            array (
                'id' => 88,
                'migration' => '2018_11_29_165519_alter_banners_table__add_slider',
                'batch' => 36,
            ),
            88 => 
            array (
                'id' => 89,
                'migration' => '2019_05_22_030224_add_account_type_to_staff_accounts',
                'batch' => 36,
            ),
            89 => 
            array (
                'id' => 90,
                'migration' => '2019_05_23_130528_alter_table_stores_add_store_name',
                'batch' => 36,
            ),
            90 => 
            array (
                'id' => 91,
                'migration' => '2019_05_23_131723_create_table_staff_accounts',
                'batch' => 36,
            ),
            91 => 
            array (
                'id' => 92,
                'migration' => '2019_05_23_135724_alter_table_countries',
                'batch' => 36,
            ),
            92 => 
            array (
                'id' => 93,
                'migration' => '2019_05_24_040704_create_brands_table',
                'batch' => 36,
            ),
            93 => 
            array (
                'id' => 94,
                'migration' => '2019_05_24_042506_add_sort_attribute_to_product',
                'batch' => 36,
            ),
            94 => 
            array (
                'id' => 95,
                'migration' => '2019_05_24_043058_add_varinat_value_to_images',
                'batch' => 36,
            ),
            95 => 
            array (
                'id' => 96,
                'migration' => '2019_05_24_220107_update-stores_table',
                'batch' => 36,
            ),
            96 => 
            array (
                'id' => 97,
                'migration' => '2019_05_24_222424_update_stores_table_creator',
                'batch' => 37,
            ),
            97 => 
            array (
                'id' => 98,
                'migration' => '2017_05_21_141039_create_categories_table',
                'batch' => 2,
            ),
            98 => 
            array (
                'id' => 99,
                'migration' => '2018_05_21_154316_create_shipping_shipping_addresses',
                'batch' => 2,
            ),
            99 => 
            array (
                'id' => 100,
                'migration' => '2019_04_22_124508_create_cart_details_table',
                'batch' => 38,
            ),
            100 => 
            array (
                'id' => 101,
                'migration' => '2019_04_23_103318_alter_carts_table_make_user_id_nullable',
                'batch' => 38,
            ),
            101 => 
            array (
                'id' => 102,
                'migration' => '2019_04_24_163950_alter_table_card_details_add_quantity',
                'batch' => 38,
            ),
            102 => 
            array (
                'id' => 103,
                'migration' => '2019_05_10_212622_create_customers_table',
                'batch' => 38,
            ),
            103 => 
            array (
                'id' => 104,
                'migration' => '2019_05_10_235418_add_names_to_shipping_addresses',
                'batch' => 38,
            ),
            104 => 
            array (
                'id' => 105,
                'migration' => '2019_05_21_123650_create_stores_table',
                'batch' => 2,
            ),
            105 => 
            array (
                'id' => 106,
                'migration' => '2019_05_21_123754_create_staff_accounts_table',
                'batch' => 2,
            ),
            106 => 
            array (
                'id' => 107,
                'migration' => '2019_05_21_160537_alter_table_stores_add_soft_deletes',
                'batch' => 2,
            ),
            107 => 
            array (
                'id' => 108,
                'migration' => '2019_05_22_111409_alter_stores_tale_change_name_to_store_name',
                'batch' => 39,
            ),
            108 => 
            array (
                'id' => 109,
                'migration' => '2019_10_11_152155_create_customer_messages_table',
                'batch' => 39,
            ),
            109 => 
            array (
                'id' => 110,
                'migration' => '2019_10_11_152305_create_customer_sales_table',
                'batch' => 39,
            ),
            110 => 
            array (
                'id' => 111,
                'migration' => '2019_10_20_023248_create_credit_cards_table',
                'batch' => 39,
            ),
            111 => 
            array (
                'id' => 112,
                'migration' => '2019_10_21_231658_add_payment_method_to_stripe_customer',
                'batch' => 39,
            ),
            112 => 
            array (
                'id' => 113,
                'migration' => '2019_12_07_191639_add_page_title_to_brand',
                'batch' => 39,
            ),
            113 => 
            array (
                'id' => 114,
                'migration' => '2019_12_11_173349_add_message_type_to_item_messages',
                'batch' => 39,
            ),
            114 => 
            array (
                'id' => 115,
                'migration' => '2020_03_06_180529_add_payment_method_to_credit_card',
                'batch' => 39,
            ),
            115 => 
            array (
                'id' => 116,
                'migration' => '2020_04_28_060742_create_cart_discounts_table',
                'batch' => 39,
            ),
            116 => 
            array (
                'id' => 117,
                'migration' => '2019_05_24_163213_create_database_table_fashion_testing',
                'batch' => 40,
            ),
            117 => 
            array (
                'id' => 118,
                'migration' => '2019_05_25_011209_add_suffix_to_stores',
                'batch' => 40,
            ),
            118 => 
            array (
                'id' => 119,
                'migration' => '2019_05_25_030013_add_user_id_to_storeaccount',
                'batch' => 40,
            ),
            119 => 
            array (
                'id' => 120,
                'migration' => '2019_05_28_023620_add_email_to_store_accounts',
                'batch' => 40,
            ),
            120 => 
            array (
                'id' => 121,
                'migration' => '2019_05_28_025424_add_type_to_store_accounts',
                'batch' => 40,
            ),
            121 => 
            array (
                'id' => 122,
                'migration' => '2019_05_28_035058_remove_created_by_to_is_created',
                'batch' => 40,
            ),
            122 => 
            array (
                'id' => 123,
                'migration' => '2019_06_02_123853_add_soft_deletes_to_customers',
                'batch' => 40,
            ),
            123 => 
            array (
                'id' => 124,
                'migration' => '2019_06_02_131919_add_city_to_customers_table',
                'batch' => 40,
            ),
            124 => 
            array (
                'id' => 125,
                'migration' => '2019_06_02_134500_create_customer_activities_table',
                'batch' => 40,
            ),
            125 => 
            array (
                'id' => 126,
                'migration' => '2019_06_03_020828_add_store_id_to_order_table',
                'batch' => 40,
            ),
            126 => 
            array (
                'id' => 127,
                'migration' => '2019_09_13_002324_fix-brands-table',
                'batch' => 40,
            ),
            127 => 
            array (
                'id' => 128,
                'migration' => '2019_09_13_002541_create-notifications-table',
                'batch' => 40,
            ),
            128 => 
            array (
                'id' => 129,
                'migration' => '2019_09_13_002608_fix-orders-table',
                'batch' => 40,
            ),
            129 => 
            array (
                'id' => 130,
                'migration' => '2019_09_13_010924_fix-cart-details-table',
                'batch' => 40,
            ),
            130 => 
            array (
                'id' => 131,
                'migration' => '2019_09_13_114032_add-discount-and-shipping-cost-to-orders',
                'batch' => 40,
            ),
            131 => 
            array (
                'id' => 132,
                'migration' => '2019_09_13_154533_add-store-id-users-table',
                'batch' => 40,
            ),
            132 => 
            array (
                'id' => 133,
                'migration' => '2019_09_19_143415_create_table_user_social',
                'batch' => 40,
            ),
            133 => 
            array (
                'id' => 134,
                'migration' => '2019_09_19_143720_alter_table_shipping_addresses_table_add_is_active',
                'batch' => 40,
            ),
            134 => 
            array (
                'id' => 135,
                'migration' => '2019_09_20_123842_create_returns_table',
                'batch' => 40,
            ),
            135 => 
            array (
                'id' => 136,
                'migration' => '2019_09_20_123923_create_social_media_providers_table',
                'batch' => 40,
            ),
            136 => 
            array (
                'id' => 137,
                'migration' => '2019_09_20_160206_add_invoice_id_to_returns_table',
                'batch' => 40,
            ),
            137 => 
            array (
                'id' => 138,
                'migration' => '2019_09_20_160510_create_wishlists_table',
                'batch' => 40,
            ),
            138 => 
            array (
                'id' => 139,
                'migration' => '2019_10_09_200726_create_payment_gateways_table',
                'batch' => 40,
            ),
            139 => 
            array (
                'id' => 140,
                'migration' => '2019_10_09_200814_create_store_payment_gateways_table',
                'batch' => 40,
            ),
            140 => 
            array (
                'id' => 141,
                'migration' => '2019_10_09_213233_add_discount_to_cart_detail_table',
                'batch' => 40,
            ),
            141 => 
            array (
                'id' => 142,
                'migration' => '2019_10_10_013721_create_payment_gateway_user_tokens_table',
                'batch' => 40,
            ),
            142 => 
            array (
                'id' => 143,
                'migration' => '2019_10_10_222122_create_customer_messages_table',
                'batch' => 38,
            ),
            143 => 
            array (
                'id' => 144,
                'migration' => '2019_10_11_000521_create_product_meta_fields_table',
                'batch' => 41,
            ),
            144 => 
            array (
                'id' => 145,
                'migration' => '2019_10_11_000914_add_has_variants_key_to_products',
                'batch' => 41,
            ),
            145 => 
            array (
                'id' => 146,
                'migration' => '2019_10_11_131047_create_sales_table',
                'batch' => 41,
            ),
            146 => 
            array (
                'id' => 147,
                'migration' => '2019_10_11_131115_create_messages_table',
                'batch' => 41,
            ),
            147 => 
            array (
                'id' => 148,
                'migration' => '2019_10_11_132828_add_message_id_to_customer_messages',
                'batch' => 41,
            ),
            148 => 
            array (
                'id' => 149,
                'migration' => '2019_10_11_132902_create_sale_items_table',
                'batch' => 41,
            ),
            149 => 
            array (
                'id' => 150,
                'migration' => '2019_10_11_212753_create_sale_item_images_table',
                'batch' => 41,
            ),
            150 => 
            array (
                'id' => 151,
                'migration' => '2019_10_15_173323_add_sort_order_to_variants_table',
                'batch' => 41,
            ),
            151 => 
            array (
                'id' => 152,
                'migration' => '2019_10_19_172338_add_cart_id_to_orders',
                'batch' => 41,
            ),
            152 => 
            array (
                'id' => 153,
                'migration' => '2019_10_19_182244_create_stripe_customers_table',
                'batch' => 41,
            ),
            153 => 
            array (
                'id' => 154,
                'migration' => '2019_10_19_182255_create_stripe_payments_table',
                'batch' => 41,
            ),
            154 => 
            array (
                'id' => 155,
                'migration' => '2019_10_20_005608_create_stripe_customer_payment_methods_table',
                'batch' => 41,
            ),
            155 => 
            array (
                'id' => 156,
                'migration' => '2019_10_20_023318_create_credit_cards_table',
                'batch' => 38,
            ),
            156 => 
            array (
                'id' => 157,
                'migration' => '2019_10_20_023517_add_is_test_to_payment_gateway',
                'batch' => 42,
            ),
            157 => 
            array (
                'id' => 158,
                'migration' => '2019_10_21_232113_add_payment_method_to_stripe_customer',
                'batch' => 42,
            ),
            158 => 
            array (
                'id' => 159,
                'migration' => '2019_11_02_152457_create_sale_item_metas_table',
                'batch' => 42,
            ),
            159 => 
            array (
                'id' => 160,
                'migration' => '2019_11_03_024930_add_category_to_sale_item',
                'batch' => 42,
            ),
            160 => 
            array (
                'id' => 161,
                'migration' => '2019_11_03_025645_add_brand_to_sale_item',
                'batch' => 42,
            ),
            161 => 
            array (
                'id' => 162,
                'migration' => '2019_11_05_151724_create_web_hooks_table',
                'batch' => 42,
            ),
            162 => 
            array (
                'id' => 163,
                'migration' => '2019_11_05_161938_add_sale_item_id_to_sale_images',
                'batch' => 42,
            ),
            163 => 
            array (
                'id' => 164,
                'migration' => '2019_11_07_035458_create_item_messages_table',
                'batch' => 42,
            ),
            164 => 
            array (
                'id' => 165,
                'migration' => '2019_11_07_062358_add_message_type',
                'batch' => 42,
            ),
            165 => 
            array (
                'id' => 166,
                'migration' => '2019_11_08_040933_create_product_views_table',
                'batch' => 42,
            ),
            166 => 
            array (
                'id' => 167,
                'migration' => '2019_11_09_231519_add_expiry_to_credit_cards',
                'batch' => 42,
            ),
            167 => 
            array (
                'id' => 168,
                'migration' => '2019_11_10_032457_create_pages_table',
                'batch' => 42,
            ),
            168 => 
            array (
                'id' => 169,
                'migration' => '2019_11_10_201555_create_social_media_users_table',
                'batch' => 42,
            ),
            169 => 
            array (
                'id' => 170,
                'migration' => '2019_11_11_000643_create_shipping_profiles_table',
                'batch' => 42,
            ),
            170 => 
            array (
                'id' => 171,
                'migration' => '2019_12_07_191926_add_page_title_to_brand',
                'batch' => 38,
            ),
            171 => 
            array (
                'id' => 172,
                'migration' => '2019_12_07_211851_add_brand_id_product',
                'batch' => 43,
            ),
            172 => 
            array (
                'id' => 173,
                'migration' => '2019_12_11_173422_add_message_type_to_item_messages',
                'batch' => 43,
            ),
            173 => 
            array (
                'id' => 174,
                'migration' => '2019_12_11_200429_create_sale_messages_table',
                'batch' => 43,
            ),
            174 => 
            array (
                'id' => 175,
                'migration' => '2019_12_11_201529_add_sale_message_id',
                'batch' => 43,
            ),
            175 => 
            array (
                'id' => 176,
                'migration' => '2019_12_11_203737_add_sale_message_id_to',
                'batch' => 43,
            ),
            176 => 
            array (
                'id' => 177,
                'migration' => '2019_12_12_231653_create_payment_methods_table',
                'batch' => 43,
            ),
            177 => 
            array (
                'id' => 178,
                'migration' => '2019_12_12_231730_create_customer_payment_methods_table',
                'batch' => 43,
            ),
            178 => 
            array (
                'id' => 179,
                'migration' => '2019_12_13_182635_add_sale_id_to_messages',
                'batch' => 43,
            ),
            179 => 
            array (
                'id' => 180,
                'migration' => '2019_12_22_050326_add_store_id_to_sales',
                'batch' => 43,
            ),
            180 => 
            array (
                'id' => 181,
                'migration' => '2019_12_22_055301_add_phone_to_store',
                'batch' => 43,
            ),
            181 => 
            array (
                'id' => 182,
                'migration' => '2019_12_22_060125_add_phone_to_store_zip',
                'batch' => 43,
            ),
            182 => 
            array (
                'id' => 183,
                'migration' => '2019_12_22_172544_create_customer_requests_table',
                'batch' => 43,
            ),
            183 => 
            array (
                'id' => 184,
                'migration' => '2019_12_24_062112_create_sale_tracking_infos_table',
                'batch' => 43,
            ),
            184 => 
            array (
                'id' => 185,
                'migration' => '2020_01_03_205657_add_is_active_to_variant',
                'batch' => 43,
            ),
            185 => 
            array (
                'id' => 186,
                'migration' => '2020_01_14_005244_create_trending_items_table',
                'batch' => 43,
            ),
            186 => 
            array (
                'id' => 187,
                'migration' => '2020_01_22_165047_add_type_to_pages',
                'batch' => 43,
            ),
            187 => 
            array (
                'id' => 188,
                'migration' => '2020_01_23_225800_create_admins_table',
                'batch' => 43,
            ),
            188 => 
            array (
                'id' => 189,
                'migration' => '2020_01_25_015547_add_token_to_stores',
                'batch' => 43,
            ),
            189 => 
            array (
                'id' => 190,
                'migration' => '2020_02_22_164236_create_product_notifications_table',
                'batch' => 43,
            ),
            190 => 
            array (
                'id' => 191,
                'migration' => '2020_02_27_021358_create_site_credits_table',
                'batch' => 43,
            ),
            191 => 
            array (
                'id' => 192,
                'migration' => '2020_02_28_184303_create_points_table',
                'batch' => 43,
            ),
            192 => 
            array (
                'id' => 193,
                'migration' => '2020_02_28_184317_create_point_histories_table',
                'batch' => 43,
            ),
            193 => 
            array (
                'id' => 194,
                'migration' => '2020_03_01_131857_add_carrier_to_cart_details',
                'batch' => 43,
            ),
            194 => 
            array (
                'id' => 195,
                'migration' => '2020_03_05_043617_add_is_default_to_customer_payment_methods',
                'batch' => 43,
            ),
            195 => 
            array (
                'id' => 196,
                'migration' => '2020_03_05_153923_create_paypal_payments_table',
                'batch' => 43,
            ),
            196 => 
            array (
                'id' => 197,
                'migration' => '2020_03_05_154305_add_credit_card_id_and_paypal_payment',
                'batch' => 43,
            ),
            197 => 
            array (
                'id' => 198,
                'migration' => '2020_03_06_180635_add_payment_method_to_credit_card',
                'batch' => 43,
            ),
            198 => 
            array (
                'id' => 199,
                'migration' => '2020_03_06_220953_add_active_to_credit_card',
                'batch' => 43,
            ),
            199 => 
            array (
                'id' => 200,
                'migration' => '2020_03_12_133237_create_sale_payment_addresses_table',
                'batch' => 43,
            ),
            200 => 
            array (
                'id' => 201,
                'migration' => '2020_03_12_153522_create_sale_payment_methods_table',
                'batch' => 43,
            ),
            201 => 
            array (
                'id' => 202,
                'migration' => '2020_03_12_161610_add_check_details',
                'batch' => 43,
            ),
            202 => 
            array (
                'id' => 203,
                'migration' => '2020_03_13_142410_create_shipping_labels_table',
                'batch' => 43,
            ),
            203 => 
            array (
                'id' => 204,
                'migration' => '2020_03_13_171300_add-status-to-sales',
                'batch' => 43,
            ),
            204 => 
            array (
                'id' => 205,
                'migration' => '2020_03_13_172309_create_sale_item_activities_table',
                'batch' => 43,
            ),
            205 => 
            array (
                'id' => 206,
                'migration' => '2020_03_13_175755_add-deleted_at',
                'batch' => 43,
            ),
            206 => 
            array (
                'id' => 207,
                'migration' => '2020_03_16_125405_add-account_type',
                'batch' => 43,
            ),
            207 => 
            array (
                'id' => 208,
                'migration' => '2020_03_17_233410_add_sale_id_to_points',
                'batch' => 43,
            ),
            208 => 
            array (
                'id' => 209,
                'migration' => '2020_03_17_234014_create_store_credits_table',
                'batch' => 43,
            ),
            209 => 
            array (
                'id' => 210,
                'migration' => '2020_03_23_003144_add_description_to_sale_item',
                'batch' => 43,
            ),
            210 => 
            array (
                'id' => 211,
                'migration' => '2020_04_07_033528_create_order_shipping_addresses_table',
                'batch' => 43,
            ),
            211 => 
            array (
                'id' => 212,
                'migration' => '2020_04_07_175857_add_stripe_customer_id_to_credit_card',
                'batch' => 43,
            ),
            212 => 
            array (
                'id' => 213,
                'migration' => '2020_04_28_060906_create_cart_discounts_table',
                'batch' => 38,
            ),
            213 => 
            array (
                'id' => 214,
                'migration' => '2020_04_29_042728_add_code_to_discount',
                'batch' => 44,
            ),
            214 => 
            array (
                'id' => 215,
                'migration' => '2020_05_01_010008_add_discount_to_cart',
                'batch' => 44,
            ),
            215 => 
            array (
                'id' => 216,
                'migration' => '2020_05_03_162555_create_store_locations_table',
                'batch' => 44,
            ),
            216 => 
            array (
                'id' => 217,
                'migration' => '2020_05_03_162628_update_shipping_profiles',
                'batch' => 44,
            ),
            217 => 
            array (
                'id' => 218,
                'migration' => '2020_05_03_191250_create_tax_rates_table',
                'batch' => 44,
            ),
            218 => 
            array (
                'id' => 219,
                'migration' => '2020_05_03_191813_create_states_table',
                'batch' => 44,
            ),
            219 => 
            array (
                'id' => 220,
                'migration' => '2020_05_03_191842_create_counties_table',
                'batch' => 44,
            ),
            220 => 
            array (
                'id' => 221,
                'migration' => '2020_05_03_202426_create_shipping_profile_prices_table',
                'batch' => 44,
            ),
            221 => 
            array (
                'id' => 222,
                'migration' => '2020_05_05_033953_add_country_and_state_id',
                'batch' => 44,
            ),
            222 => 
            array (
                'id' => 223,
                'migration' => '2020_05_06_052132_add_description_to_shipping_prices',
                'batch' => 44,
            ),
            223 => 
            array (
                'id' => 224,
                'migration' => '2020_05_07_015532_add_price_to_shipping_profile_prices',
                'batch' => 44,
            ),
            224 => 
            array (
                'id' => 225,
                'migration' => '2020_05_07_020331_add_price_to_shipping_profile',
                'batch' => 44,
            ),
            225 => 
            array (
                'id' => 226,
                'migration' => '2020_05_12_015945_add_shipping_profile_id_to_cart',
                'batch' => 44,
            ),
            226 => 
            array (
                'id' => 227,
                'migration' => '2020_05_17_193600_add_balance_to_store_credits',
                'batch' => 44,
            ),
            227 => 
            array (
                'id' => 228,
                'migration' => '2020_05_17_194350_add_balance_to_store',
                'batch' => 44,
            ),
            228 => 
            array (
                'id' => 229,
                'migration' => '2020_05_18_000417_create_store_credit_transcations_table',
                'batch' => 44,
            ),
            229 => 
            array (
                'id' => 230,
                'migration' => '2020_05_20_214119_create_payment_customers_table',
                'batch' => 44,
            ),
            230 => 
            array (
                'id' => 231,
                'migration' => '2020_05_20_221857_create_paypal_customers_table',
                'batch' => 44,
            ),
            231 => 
            array (
                'id' => 232,
                'migration' => '2020_05_20_223003_add_given_name',
                'batch' => 44,
            ),
            232 => 
            array (
                'id' => 233,
                'migration' => '2020_09_19_204452_add_shipping_address_id_to_carts',
                'batch' => 45,
            ),
            233 => 
            array (
                'id' => 234,
                'migration' => '2020_09_19_205626_add_completed_address_id_to_carts',
                'batch' => 46,
            ),
            234 => 
            array (
                'id' => 235,
                'migration' => '2020_09_20_215339_create_order_shipping_profiles_table',
                'batch' => 47,
            ),
            235 => 
            array (
                'id' => 236,
                'migration' => '2020_09_20_215348_create_order_shipping_profile_prices_table',
                'batch' => 47,
            ),
            236 => 
            array (
                'id' => 237,
                'migration' => '2020_09_30_010345_add_is_guest_to_users',
                'batch' => 48,
            ),
            237 => 
            array (
                'id' => 239,
                'migration' => '2014_10_12_200000_add_two_factor_columns_to_users_table',
                'batch' => 49,
            ),
            238 => 
            array (
                'id' => 240,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 50,
            ),
            239 => 
            array (
                'id' => 241,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 50,
            ),
            240 => 
            array (
                'id' => 242,
                'migration' => '2020_05_21_100000_create_teams_table',
                'batch' => 50,
            ),
            241 => 
            array (
                'id' => 243,
                'migration' => '2020_05_21_200000_create_team_user_table',
                'batch' => 50,
            ),
            242 => 
            array (
                'id' => 244,
                'migration' => '2020_10_09_221850_create_sessions_table',
                'batch' => 50,
            ),
            243 => 
            array (
                'id' => 245,
                'migration' => '2020_11_28_031122_create_store_groups_table',
                'batch' => 51,
            ),
            244 => 
            array (
                'id' => 246,
                'migration' => '2020_11_28_031148_create_store_permissions_table',
                'batch' => 51,
            ),
            245 => 
            array (
                'id' => 247,
                'migration' => '2020_11_28_031248_create_store_group_permissions_table',
                'batch' => 51,
            ),
            246 => 
            array (
                'id' => 248,
                'migration' => '2020_11_28_033126_create_store_users_table',
                'batch' => 51,
            ),
            247 => 
            array (
                'id' => 249,
                'migration' => '2019_11_05_163245_add_sale_item_id_to_sale_images',
                'batch' => 52,
            ),
            248 => 
            array (
                'id' => 250,
                'migration' => '2021_05_01_155132_create_login_table',
                'batch' => 53,
            ),
            249 => 
            array (
                'id' => 251,
                'migration' => '2021_05_01_230954_create_store_notifications_table',
                'batch' => 54,
            ),
            250 => 
            array (
                'id' => 252,
                'migration' => '2021_05_01_231019_create_store_notification_messages_table',
                'batch' => 54,
            ),
            251 => 
            array (
                'id' => 253,
                'migration' => '2021_05_01_231049_create_store_notification_categories_table',
                'batch' => 54,
            ),
            252 => 
            array (
                'id' => 254,
                'migration' => '2021_05_09_171952_create_theme_templates_table',
                'batch' => 55,
            ),
            253 => 
            array (
                'id' => 255,
                'migration' => '2021_05_09_182242_create_store_themes_table',
                'batch' => 55,
            ),
            254 => 
            array (
                'id' => 256,
                'migration' => '2021_05_09_183418_create_store_domains_table',
                'batch' => 55,
            ),
            255 => 
            array (
                'id' => 257,
                'migration' => '2021_05_15_165303_create_discount_products_table',
                'batch' => 56,
            ),
            256 => 
            array (
                'id' => 258,
                'migration' => '2021_05_15_165312_create_discount_categories_table',
                'batch' => 56,
            ),
            257 => 
            array (
                'id' => 259,
                'migration' => '2021_05_15_165324_create_discount_countries_table',
                'batch' => 56,
            ),
            258 => 
            array (
                'id' => 260,
                'migration' => '2021_05_15_172942_create_discount_customers_table',
                'batch' => 56,
            ),
            259 => 
            array (
                'id' => 261,
                'migration' => '2021_05_15_175956_create_store_industries_table',
                'batch' => 57,
            ),
            260 => 
            array (
                'id' => 262,
                'migration' => '2021_05_15_180145_create_timezones_table',
                'batch' => 58,
            ),
            261 => 
            array (
                'id' => 263,
                'migration' => '2021_05_19_152441_create_request_logs_table',
                'batch' => 59,
            ),
            262 => 
            array (
                'id' => 264,
                'migration' => '2021_05_25_221859_create_store_invites_table',
                'batch' => 59,
            ),
            263 => 
            array (
                'id' => 265,
                'migration' => '2021_05_31_132336_create_units_table',
                'batch' => 60,
            ),
            264 => 
            array (
                'id' => 266,
                'migration' => '2021_06_27_164220_create_store_plans_table',
                'batch' => 61,
            ),
            265 => 
            array (
                'id' => 267,
                'migration' => '2021_06_30_150506_create_tags_table',
                'batch' => 62,
            ),
            266 => 
            array (
                'id' => 268,
                'migration' => '2021_09_13_225410_create_sales_methods_table',
                'batch' => 63,
            ),
            267 => 
            array (
                'id' => 269,
                'migration' => '2021_07_17_050131_create_sessions_table',
                'batch' => 64,
            ),
            268 => 
            array (
                'id' => 270,
                'migration' => '2021_09_19_235523_create_payment_systems_table',
                'batch' => 64,
            ),
            269 => 
            array (
                'id' => 271,
                'migration' => '2021_09_20_001750_create_store_locations_table',
                'batch' => 65,
            ),
            270 => 
            array (
                'id' => 272,
                'migration' => '2021_09_24_122549_create_navigations_table',
                'batch' => 66,
            ),
            271 => 
            array (
                'id' => 273,
                'migration' => '2021_09_24_210534_create_navigation_lists_table',
                'batch' => 67,
            ),
            272 => 
            array (
                'id' => 274,
                'migration' => '2021_09_25_125351_create_user_store_notifications_table',
                'batch' => 68,
            ),
            273 => 
            array (
                'id' => 275,
                'migration' => '2021_09_26_000827_create_page_contents_table',
                'batch' => 68,
            ),
            274 => 
            array (
                'id' => 276,
                'migration' => '2021_09_26_000847_create_template_page_contents_table',
                'batch' => 68,
            ),
            275 => 
            array (
                'id' => 277,
                'migration' => '2021_09_26_000856_create_store_page_contents_table',
                'batch' => 68,
            ),
            276 => 
            array (
                'id' => 278,
                'migration' => '2021_09_26_000909_create_store_page_sections_table',
                'batch' => 68,
            ),
            277 => 
            array (
                'id' => 279,
                'migration' => '2021_09_26_000921_create_template_page_sections_table',
                'batch' => 68,
            ),
            278 => 
            array (
                'id' => 280,
                'migration' => '2021_10_11_214023_create_store_user_invites_table',
                'batch' => 68,
            ),
            279 => 
            array (
                'id' => 281,
                'migration' => '2021_10_11_215306_create_collection_conditions_table',
                'batch' => 68,
            ),
            280 => 
            array (
                'id' => 282,
                'migration' => '2021_10_11_225851_create_collections_table',
                'batch' => 68,
            ),
            281 => 
            array (
                'id' => 283,
                'migration' => '2021_10_13_033218_create_product_types_table',
                'batch' => 69,
            ),
            282 => 
            array (
                'id' => 284,
                'migration' => '2021_10_13_054251_create_store_activities_table',
                'batch' => 69,
            ),
            283 => 
            array (
                'id' => 288,
                'migration' => '2021_10_14_205405_create_custom_product_types_table',
                'batch' => 70,
            ),
            284 => 
            array (
                'id' => 289,
                'migration' => '2021_10_15_143145_create_shipping_rate_conditions_table',
                'batch' => 70,
            ),
            285 => 
            array (
                'id' => 290,
                'migration' => '2021_10_15_143313_create_shipping_rates_table',
                'batch' => 70,
            ),
            286 => 
            array (
                'id' => 291,
                'migration' => '2021_10_16_140104_create_shipping_rate_profiles_table',
                'batch' => 71,
            ),
            287 => 
            array (
                'id' => 292,
                'migration' => '2021_10_16_211413_create_product_options_table',
                'batch' => 71,
            ),
            288 => 
            array (
                'id' => 293,
                'migration' => '2021_10_16_211422_create_product_tags_table',
                'batch' => 71,
            ),
            289 => 
            array (
                'id' => 294,
                'migration' => '2021_10_20_181125_create_order_tags_table',
                'batch' => 71,
            ),
            290 => 
            array (
                'id' => 296,
                'migration' => '2021_10_20_182513_create_order_activities_table',
                'batch' => 72,
            ),
            291 => 
            array (
                'id' => 297,
                'migration' => '2021_10_31_060046_create_shipping_gateways_table',
                'batch' => 73,
            ),
            292 => 
            array (
                'id' => 298,
                'migration' => '2021_11_25_032048_create_order_customer_notes_table',
                'batch' => 74,
            ),
            293 => 
            array (
                'id' => 299,
                'migration' => '2021_11_25_061315_create_withdrawals_table',
                'batch' => 75,
            ),
            294 => 
            array (
                'id' => 300,
                'migration' => '2021_11_25_061331_create_withdrawal_requests_table',
                'batch' => 75,
            ),
            295 => 
            array (
                'id' => 301,
                'migration' => '2021_11_25_091257_create_order_billing_addresses_table',
                'batch' => 75,
            ),
            296 => 
            array (
                'id' => 302,
                'migration' => '2021_11_25_150053_create_withdrawal_account_details_table',
                'batch' => 75,
            ),
            297 => 
            array (
                'id' => 303,
                'migration' => '2021_12_15_125720_alter_customers_table_add_notify',
                'batch' => 75,
            ),
            298 => 
            array (
                'id' => 304,
                'migration' => '2021_12_16_160212_alter_order_billing_addresses_table_add_order_id',
                'batch' => 76,
            ),
            299 => 
            array (
                'id' => 305,
                'migration' => '2021_12_16_160818_create_order_discounts_table',
                'batch' => 76,
            ),
            300 => 
            array (
                'id' => 306,
                'migration' => '2021_12_24_115205_alter_notifications_table_change_message__from_text_to_longtext',
                'batch' => 77,
            ),
            301 => 
            array (
                'id' => 308,
                'migration' => '2021_12_24_125325_create_store_actual_notifications_table',
                'batch' => 78,
            ),
            302 => 
            array (
                'id' => 309,
                'migration' => '2022_01_05_114006_alter_store_actual_notifications_table_change_notifications_to_message',
                'batch' => 79,
            ),
            303 => 
            array (
                'id' => 312,
                'migration' => '2022_01_07_135626_create_email_marketing_settings_table',
                'batch' => 80,
            ),
            304 => 
            array (
                'id' => 313,
                'migration' => '2022_01_10_132059_create_payout_settings_table',
                'batch' => 81,
            ),
            305 => 
            array (
                'id' => 314,
                'migration' => '2022_01_10_132424_create_remittances_table',
                'batch' => 81,
            ),
            306 => 
            array (
                'id' => 317,
                'migration' => '2022_01_13_164135_alter_customers_table_change_country_to_coutry_id',
                'batch' => 83,
            ),
            307 => 
            array (
                'id' => 318,
                'migration' => '2022_01_13_154152_alter_table_customers_add_user_id',
                'batch' => 84,
            ),
            308 => 
            array (
                'id' => 319,
                'migration' => '2022_01_21_112101_create_shopmata_table',
                'batch' => 0,
            ),
        ));
        
        
    }
}