<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $this->call(AnalyticsTableSeeder::class);
        $this->call(CartDetailsTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
//        $this->call(CollectionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CustomerPaymentMethodsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(DefaultPagesTableSeeder::class);
        $this->call(DesignersTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(EmailMarketingSettingsTableSeeder::class);
        $this->call(LoginsTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(NavigationListsTableSeeder::class);
        $this->call(NavigationsTableSeeder::class);
        $this->call(OauthAccessTokensTableSeeder::class);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
        $this->call(OpenEditorPagesTableSeeder::class);
        $this->call(OrderActivitiesTableSeeder::class);
        $this->call(OrderShippingAddressesTableSeeder::class);
        $this->call(OrderShippingProfilePricesTableSeeder::class);
        $this->call(OrderShippingProfilesTableSeeder::class);
        $this->call(OrderTagsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PaymentGatewaysTableSeeder::class);
        $this->call(PayoutSettingsTableSeeder::class);
        $this->call(ProductAttributesTableSeeder::class);
        $this->call(ProductImagesTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(SalesMethodsTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(ShippingAddressesTableSeeder::class);
        $this->call(ShippingGatewaysTableSeeder::class);
        $this->call(ShippingRateConditionsTableSeeder::class);
//        $this->call(ShippingRatesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(StoreActivitiesTableSeeder::class);
        $this->call(StoreActualNotificationsTableSeeder::class);
        $this->call(StoreDomainsTableSeeder::class);
        $this->call(StoreGroupsTableSeeder::class);
        $this->call(StoreIndustriesTableSeeder::class);
        $this->call(StoreLocationsTableSeeder::class);
        $this->call(StoreNotificationCategoriesTableSeeder::class);
        $this->call(StoreNotificationsTableSeeder::class);
        $this->call(StorePaymentGatewaysTableSeeder::class);
        $this->call(StoreUsersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ThemeFilesTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(TimezonesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
