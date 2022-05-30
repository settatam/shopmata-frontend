import axios from 'axios'
import urls from "./urls";

export const postAsNativeForm = ((action, params) => {
    let form  = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', action);
    for (let key in params) {
        if (params.hasOwnProperty(key)) {
            let hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);
            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
})

export const bulkActionForTransactions = () => '/admin/transactions/bulk-print-action';
