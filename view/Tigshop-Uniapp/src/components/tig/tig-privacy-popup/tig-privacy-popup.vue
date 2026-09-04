<template>
    <!-- #ifdef MP-WEIXIN -->
    <tig-popup v-model:show="visible" position="center" :show-close="false" :mask-click="false" :round="16" :z-index="9999">
        <view class="privacy-popup">
            <view class="privacy-title">{{ $t("用户隐私保护提示") }}</view>
            <view class="privacy-content">
                <text>{{ $t("在你使用我们的服务前,请仔细阅读") }}</text>
                <text class="privacy-link" @click="goPrivacy">{{ $t("《隐私政策》") }}</text>
                <text>{{ $t("和") }}</text>
                <text class="privacy-link" @click="goService">{{ $t("《用户服务协议》") }}</text>
                <text>{{ $t("。如你同意,请点击“同意”开始使用我们的产品和服务。") }}</text>
            </view>
            <view class="privacy-btns">
                <button class="privacy-btn privacy-btn-disagree" @click="onDisagree">{{ $t("拒绝") }}</button>
                <button id="agree-btn" open-type="agreePrivacyAuthorization" class="privacy-btn privacy-btn-agree" @click="onAgree">
                    {{ $t("同意") }}
                </button>
            </view>
        </view>
    </tig-popup>
    <!-- #endif -->
</template>

<script setup lang="ts">
// #ifdef MP-WEIXIN
import { computed } from "vue";
import { privacyPopupVisible, agreePrivacyAuthorization, disagreePrivacyAuthorization } from "@/utils/privacy";

const visible = computed({
    get: () => privacyPopupVisible.value,
    set: (val: boolean) => (privacyPopupVisible.value = val)
});

const onAgree = () => agreePrivacyAuthorization("agree-btn");
const onDisagree = () => disagreePrivacyAuthorization();

const goPrivacy = () => uni.navigateTo({ url: "/pages/login/mallAgreement?articleSn=ysxy" });
const goService = () => uni.navigateTo({ url: "/pages/login/mallAgreement?articleSn=fwxy" });
// #endif
</script>

<style lang="scss" scoped>
/* #ifdef MP-WEIXIN */
.privacy-popup {
    width: 600rpx;
    padding: 50rpx 40rpx 40rpx;
    box-sizing: border-box;
    background-color: #fff;
    border-radius: 24rpx;
}
.privacy-title {
    font-size: 34rpx;
    font-weight: bold;
    text-align: center;
    color: #333;
}
.privacy-content {
    margin-top: 30rpx;
    font-size: 26rpx;
    line-height: 1.7;
    color: #666;
    text-align: justify;
}
.privacy-link {
    color: var(--general, #ff5000);
}
.privacy-btns {
    display: flex;
    align-items: center;
    margin-top: 44rpx;
}
.privacy-btn {
    flex: 1;
    height: 80rpx;
    line-height: 80rpx;
    margin: 0;
    padding: 0;
    font-size: 30rpx;
    text-align: center;
    border-radius: 40rpx;
    &::after {
        border: 0;
    }
}
.privacy-btn-disagree {
    margin-right: 20rpx;
    color: #999;
    background-color: #f5f5f5;
}
.privacy-btn-agree {
    color: #fff;
    background-color: var(--general, #ff5000);
}
/* #endif */
</style>
