import  notification from './notification'

export default   () => {

    const saveFiles = (files, args = {}, ...params) => {

        const  formData = new FormData()
        const  {  url  } = args;

        files.map(file => {
            formData.append('files[]', file)
            formData.append('type', 'image')
            return formData
        })
        
        return axios
            .post(
                url,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
            .then(response => {
                return Promise.resolve(response)
            })
            .catch(err => {
                return Promise.reject()
            })
        }


        const deleteImage = (args = {}) => {
            const  { image_id, image_url, index, loading, url, message, images } = args;
            const  { onClickTop, onClickBot } = notification();
            loading.value = index
            return  axios
                .post(url, { image_id, image_url })
                .then(res => {
                    if (res.data.images !== "undefined" ) {
                        images.value = res.data.images
                    }
                    loading.value = null
                    message.value = 'Image deleted'
                    setTimeout(onClickTop, 2000)
                    return Promise.resolve()
                })
                .catch(error => {
                    loading.value = false
                    message.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }
        
    return { saveFiles, deleteImage };
}
