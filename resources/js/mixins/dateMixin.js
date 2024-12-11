import moment from "moment";

export default {
    methods: {
        convertUTCDateToLocalDate(date, format = "DD MMM YYYY") {
            return moment.utc(date).local().format(format);
        },
    },
};
