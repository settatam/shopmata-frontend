import { notify } from "notiwind";

export default () => {
    const notifyAlert = (message, group, title) => {
        notify(
            {
                group: group,
                title: title,
                text: message,
            },
            4000
        );
    };

    const onClickBot = (message) => {
        notify(
            {
                group: "bottom",
                title: "Error",
                text: message,
            },
            4000
        );
    };

    const onClickTop = (message) => {
        notify(
            {
                group: "top",
                title: "Success",
                text: message,
            },
            4000
        );
    };

    return { onClickBot, onClickTop, notifyAlert };
};
