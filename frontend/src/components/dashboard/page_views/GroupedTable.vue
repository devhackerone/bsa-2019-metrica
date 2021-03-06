<template>
    <VContainer
        class="position-relative"
    >
        <Spinner v-if="isFetching" />
        <VRow
            class="header my-3"
            fluid
        >
            <VCol>
                <slot name="page">
                    Page
                </slot>
            </VCol>
            <VCol>
                <slot name="title">
                    Title
                </slot>
            </VCol>
            <VCol>
                <slot name="bounce-rate">
                    Bounce rate
                </slot>
            </VCol>
            <VCol>
                <slot name="exit-rate">
                    Exit rate
                </slot>
            </VCol>
            <VCol>
                <slot name="page-views">
                    Page views
                </slot>
            </VCol>
        </VRow>
        <VDataTable
            class="caption"
            hide-default-footer
            hide-default-header
            :headers="headers"
            :items="items"
        />
    </VContainer>
</template>

<script>
    import Spinner from "@/components/utilites/Spinner";
    import {IS_FETCHING} from "@/store/modules/page_views/types/getters";
    import {FETCH_PAGE_VIEWS_TABLE_DATA} from "@/store/modules/page_views/types/actions";
    import {mapGetters, mapActions} from 'vuex';

    export default {
        components: {Spinner},
        name: 'GroupedTable',
        props: {
            items: {
                type: Array,
                required: true
            }
        },
        data () {
            return {
                headers: [
                    { text: '', align: 'center', value: 'page_url' },
                    { text: '', align: 'center', value: 'page_title' },
                    { text: '', align: 'center', value: 'bounce_rate' },
                    { text: '', align: 'center', value: 'exit_rate' },
                    { text: '', align: 'center', value: 'count_page_views' },
                ],
            };
        },
        created() {
            this.fetchTableData();
        },
        computed: {
            ...mapGetters('page_views', {
                isFetching: IS_FETCHING
            }),
        },
        methods: {
            ...mapActions('page_views', {
                fetchTableData: FETCH_PAGE_VIEWS_TABLE_DATA
            }),
        }
    };
</script>

<style scoped lang="scss">
    $dark: #122737;
    $blue: #3C57DE;
    $gray: rgba(18, 39, 55, 0.5);

    ::v-deep .v-data-table {
        font-family: 'GilroySemiBold';
    }

    .header {
        align-items: center;
        text-align: center;
        text-transform: capitalize;
    }

    .container {

        .v-data-table {
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 6px;
            color: $gray;
            line-height: 14px;
            box-shadow: 0px 0px 28px rgba(194, 205, 223, 0.7);

            ::v-deep tr {
                min-height: 52px;
                display: flex;
                align-items: center;
                border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important;

                &:last-child {
                    border-style: none !important;
                }

                td {
                    height: max-content;
                    flex: 1;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    word-break: break-all;
                    padding: 8px;
                }
            }
        }
    }
</style>