import axios from 'axios'
import urls from "./urls";
import {Inertia} from "@inertiajs/inertia";

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

export const fileUploader = (action, params) => {
    let formData = new FormData()
    for (let key in params) {
        formData.append(key, params[key]);
    }
    return axios.post(action, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
}

export const getTransactionActionType = (action) => {
    switch (action) {
        case '':
            break;
        default:
            return 'status';
    }
}
