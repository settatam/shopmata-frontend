import notification from "./notification";

export default () => {
    const saveFiles = (files, payload = null, values = null) => {
        const formData = new FormData();

        //console.log(values);

        files.map((file) => {
            formData.append("files[]", file);
            formData.append("type", "image");
            if (typeof payload != null) {
                formData.append("model", payload.model);
                formData.append("model_id", payload.model_id);
                formData.append("transaction_id", payload.transaction_id);
            }

            return formData;
        });

        return axios
            .post("/admin/images", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                return Promise.resolve(response);
            })
            .catch((err) => {
                return Promise.reject();
            });
    };

    const deleteImage = (args = {}) => {
        const { image_id, image_url, index, loading, url, message, images } =
            args;
        const { onClickTop, onClickBot } = notification();
        loading.value = index;
        return axios
            .post(url, { image_id, image_url, values })
            .then((res) => {
                if (res.data.images !== "undefined") {
                    images.value = res.data.images;
                }
                loading.value = null;
                message.value = "Image deleted";
                setTimeout(onClickTop, 2000);
                return Promise.resolve();
            })
            .catch((error) => {
                loading.value = false;
                message.value = "Error processing your request";
                setTimeout(onClickBot, 2000);
            });
    };

    return { saveFiles, deleteImage };
};
