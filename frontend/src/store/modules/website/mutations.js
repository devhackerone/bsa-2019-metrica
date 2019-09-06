import {
    UPDATE_CURRENT_WEBSITE,
    SET_CURRENT_WEBSITE,
    SET_WEBSITE_INFO,
    RESET_CURRENT_WEBSITE,
    SET_FETCH_TRUE,
    RESET_WEBSITE_DATA,
    SET_SELECTED_WEBSITE,
    SET_IS_FETCH_WEBSITES,
    RESET_FETCH_WEBSITES,
    SET_RELATE_WEBSITES,
    SET_DEFAULT_SELECTED_WEBSITE
} from "./types/mutations";

export default {
    [SET_WEBSITE_INFO]: (state, data) => {
        state.newWebsite = {
            ...state.newWebsite,
            ...data,
        };
    },
    [SET_CURRENT_WEBSITE]: (state, website) => {
        state.isCurrentWebsite = true;
        state.currentWebsite = website;
    },
    [UPDATE_CURRENT_WEBSITE]: (state, website) => {
        state.currentWebsite = {
            ...state.currentWebsite,
            ...website
        };
    },
    [RESET_CURRENT_WEBSITE]: (state) => {
        state.currentWebsite = {
            name: '',
            domain: '',
            single_page: false,
            tracking_number: ''
        };
        state.isCurrentWebsite = false;
    },
    [SET_FETCH_TRUE]: (state) => {
        state.isFetchedWebsite = true;
    },
    [RESET_WEBSITE_DATA]: (state) => {
        state.newWebsite = {
            name: '',
            domain: '',
            single_page: false,
        };
        state.currentWebsite = {
            name: '',
            domain: '',
            single_page: false,
            tracking_number: ''
        };
        state.isCurrentWebsite = false;
        state.isFetchedWebsite = false;
    },
    [SET_SELECTED_WEBSITE]: (state, data) => {
        state.relateUserWebsites.selectedWebsite = {
            ...state.relateUserWebsites.selectedWebsite,
            ...data
        };
        state.currentWebsite.id = data.id;
    },
    [SET_IS_FETCH_WEBSITES]: (state) => {
        state.relateUserWebsites.isFetching = true;
    },
    [RESET_FETCH_WEBSITES]: (state) => {
        state.relateUserWebsites.isFetching = false;
    },
    [SET_RELATE_WEBSITES]: (state, data) => {
        state.relateUserWebsites.websites = data;
    },
    [SET_DEFAULT_SELECTED_WEBSITE]: (state, data) => {
        state.relateUserWebsites.selectedWebsite.value = data.domain;
    }
};
