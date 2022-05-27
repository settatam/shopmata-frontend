export default {
    transactions: {
        main: id => `/admin/transactions/${id}`,
        bulkAction: action => `/admin/transactions/${action}`,
        newKit: id => `/admin/transactions/${id}/create-new-kit`,
        message: id => `/admin/transactions/${id}/messages`
    }
}
