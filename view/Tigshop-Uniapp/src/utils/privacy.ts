import { ref } from "vue";

// #ifdef MP-WEIXIN
declare const wx: any;
// #endif

/**
 * 微信小程序「用户隐私保护」授权逻辑封装
 * 文档: https://developers.weixin.qq.com/miniprogram/dev/framework/user-privacy/PrivacyAuthorize.html
 *
 * 机制:
 *  1. 在 App onLaunch 中调用 initPrivacyAuthorization() 注册监听。
 *  2. 当小程序调用受保护隐私接口(如 chooseImage / saveImageToPhotosAlbum /
 *     chooseAddress / getPhoneNumber 等)且用户尚未同意《隐私保护指引》时,
 *     微信会自动触发 onNeedPrivacyAuthorization 回调,我们借此弹出自定义授权弹窗。
 *  3. 用户点击「同意」时,必须通过带 open-type="agreePrivacyAuthorization" 的
 *     <button id="agree-btn"> 触发,并以 { event: "agree", buttonId: "agree-btn" }
 *     调用 resolve,本次隐私接口才会继续执行。
 */

/** 隐私授权弹窗全局显示状态(供 tig-privacy-popup 组件消费) */
export const privacyPopupVisible = ref(false);

/** 当前待处理的授权 resolve 回调 */
let currentResolve: ((res: { event: string; buttonId?: string }) => void) | null = null;

/** 注册隐私授权监听,需在 App onLaunch 中调用一次 */
export function initPrivacyAuthorization() {
    // #ifdef MP-WEIXIN
    if (typeof wx === "undefined" || typeof wx.onNeedPrivacyAuthorization !== "function") {
        return;
    }
    wx.onNeedPrivacyAuthorization((resolve: (res: { event: string; buttonId?: string }) => void) => {
        currentResolve = resolve;
        privacyPopupVisible.value = true;
    });
    // #endif
}

/** 用户点击「同意」,放行被拦截的隐私接口 */
export function agreePrivacyAuthorization(buttonId = "agree-btn") {
    // #ifdef MP-WEIXIN
    if (currentResolve) {
        currentResolve({ event: "agree", buttonId });
        currentResolve = null;
    }
    // #endif
    privacyPopupVisible.value = false;
}

/** 用户点击「拒绝」,本次隐私接口将以失败回调结束 */
export function disagreePrivacyAuthorization() {
    // #ifdef MP-WEIXIN
    if (currentResolve) {
        currentResolve({ event: "disagree" });
        currentResolve = null;
    }
    // #endif
    privacyPopupVisible.value = false;
}
