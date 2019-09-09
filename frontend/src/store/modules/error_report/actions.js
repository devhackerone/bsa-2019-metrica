import {
    CHANGE_SELECTED_PERIOD,
    FETCH_PAGE_DATA,
    FETCH_CHART_DATA,
} from "./types/actions";

import {
    SET_SELECTED_PERIOD,
    SET_CHART_VALUES,
    RESET_CHART_FETCHING,
    SET_CHART_FETCHING
} from "./types/mutations";

export default {
    [CHANGE_SELECTED_PERIOD]: (context, payload) => {
        context.commit(SET_SELECTED_PERIOD, payload.value);
        context.dispatch(FETCH_PAGE_DATA);
    },
    [FETCH_PAGE_DATA]: (context) => {
        context.dispatch(FETCH_CHART_DATA);
    },

    [FETCH_CHART_DATA]: (context) => {
        context.commit(SET_CHART_FETCHING);

        const items = [
            {
                date:'1565700000',
                value:2,
            },
            {
                date:'1565820000',
                value:2,
            },
        ];
        new Promise((resolve) => {

            resolve(items);

        }).then(response => {

            context.commit(SET_CHART_VALUES, response);
            context.commit(RESET_CHART_FETCHING);

        }).finally(() => context.commit(RESET_CHART_FETCHING));
    },
};