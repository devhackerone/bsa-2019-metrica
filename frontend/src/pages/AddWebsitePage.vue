<template>
    <VContainer
        fluid
        pa-0
        class="left-container"
    >
        <ContentLayout>
            <VFlex
                lg12
                md12
                sm12
                xs12
                class="content-card"
            >
                <VLayout
                    wrap
                    align-center
                    justify-center
                >
                    <VFlex
                        xs10
                        sm10
                        md10
                        lg10
                    >
                        <StepsProgressBar :step-number="stepNumber" />
                        <RouterView />
                    </VFlex>
                </VLayout>
            </VFlex>
        </ContentLayout>
        <VFlex
            lg6
            md6
            hidden-sm-and-down
            height="100%"
            class="img-card"
        >
            <VImg :src="require('@/assets/running_man.jpg')" />
        </VFlex>
    </VContainer>
</template>

<script>
    import ContentLayout from '../components/layout/ContentLayout.vue';
    import store from "../store";
    import StepsProgressBar from '@/components/website/adding_master/StepsProgressBar.vue';

    export default {
        name: 'AddWebsitePage',
        components: {
            StepsProgressBar,
            ContentLayout
        },
        computed: {
            stepNumber () {
                return this.$route.meta.step;
            }
        },
        beforeRouteEnter: (to, from, next) => {
            if (store.state.website.isCurrentWebsite) {
                next({
                    name: 'websiteinfo'
                });
            } else {
                next();
            }
        }
    };
</script>

<style lang="scss" scoped>
    .content-card {
        background-color: rgb(245, 248, 253);

        ::v-deep .form-card {
            padding-top: 15px;

            .title-text {
                letter-spacing: 0.4px;
                line-height: 15px;
                color: rgba(18, 39, 55, 0.5);
            }
        }
    }
    .img-card {
        background-color: white;
    }
    .left-container {
        display: flex;
    }
</style>
