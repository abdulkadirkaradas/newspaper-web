import moment from 'moment';

export function useDate() {
  const convertUTCDateToLocalDate = (date, format = 'DD MMM YYYY') => {
    return moment.utc(date).local().format(format);
  };

  return {
    convertUTCDateToLocalDate
  };
}