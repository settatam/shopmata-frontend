export default {
    transactions: {
        main: (id) => `/admin/transactions/${id}`,
        bulkAction: (action) => `/admin/transactions/bulk-actions/${action}`,
        newKit: (id) => `/admin/transactions/${id}/create-new-kit`,
        message: (id) => `/admin/transactions/${id}/messages`,
        bin_location: (id) => `/admin/transactions/${id}/bin_location`,
    },
    reports: {
        formGroup: () => '/reports/form-group'
    }
};
