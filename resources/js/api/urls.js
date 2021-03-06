export default {
    transactions: {
        main: (id) => `/admin/transactions/${id}`,
        bulkAction: (action) => `/admin/transactions/bulk-actions/${action}`,
        newKit: (id) => `/admin/transactions/${id}/create-new-kit`,
        message: (id) => `/admin/transactions/${id}/messages`,
        bin_location: (id) => `/admin/transactions/${id}/bin_location`,
        sms: (id) => `/admin/transactions/${id}/sms`,
        payment: (id) => `/admin/customer/${id}/payment`,
    },
    reports: {
        formGroup: () => `/admin/reports/form-group`,
        export: () => `/admin/reports/export`,
    },
    assets: {
        uploader: () => "/admin/online-store/code-editor/uploader",
    },
    createstore: {
        create: () => "/admin/stores",
    },
    paymentInformation: {
        get: (id) => `/admin/payment-information/${id}`,
        save: (id) => `/admin/payment-information/${id}`
    },
    customers: {
        information: () => `/admin/customers/${id}`,
    },
};
