<template>
    <tig-layout>
        <styleThreeCate :height="height" />
        
        <!-- 客服聊天悬浮按钮 -->
        <view class="floating-service-btn">
            <service>
                <image class="service-icon" :src="staticResource('product/service.png')" mode="aspectFit" />
            </service>
        </view>
    </tig-layout>
</template>

<script lang="ts" setup>
import { onLoad } from "@dcloudio/uni-app";
import { ref, computed } from "vue";
import styleOneCate from "./styleOneCate.vue";
import styleTwoCate from "./styleTwoCate.vue";
import styleThreeCate from "./styleThreeCate.vue";
import { useConfigStore } from "@/store/config";
import { useTabbarStore } from "@/store/tabbar";
import service from "@/components/service/index.vue";
import { staticResource } from "@/utils";

const configStore = useConfigStore();

const tabbarStore = useTabbarStore();

const catId = ref(0);

onLoad((options) => {
    if (options && options.categoryId) {
        catId.value = options.categoryId;
    }
});

const height = computed(() => {
    return `calc(${configStore.windowInfo.screenHeight}px - var(${tabbarStore.currentActiveValue > -1 ? "--tabbar-height" : "--safe-bottom"}) - var(--nav-height))`;
});
</script>
<style>
/* 兼容小程序 */
page {
    background-color: #fff !important;
}
</style>
<style lang="scss" scoped>
.floating-service-btn {
    position: fixed;
    bottom: calc(var(--tabbar-height) + 30rpx);
    left: 30rpx;
    z-index: 99;
    width: 90rpx;
    height: 90rpx;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 0 4rpx 16rpx rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #eee;
    
    .service-icon {
        width: 50rpx;
        height: 50rpx;
    }
}
</style>
