# 微信小程序《用户隐私保护指引》对齐文档

> 本文件基于对 `src/` 源码与构建产物 `dist/build/mp-weixin/app.json` 的实际核对整理，
> 用于在微信公众平台后台（**设置 → 服务内容声明 → 用户隐私保护指引**）逐项填写，
> 确保「后台声明的隐私用途」与「代码真实调用的隐私接口」一致，避免真机被拦截或审核驳回。

---

## 一、构建产物（app.json）当前状态核对

```json
"__usePrivacyCheck__": true,
"permission": {
  "scope.writePhotosAlbum": { "desc": "为了更好地为您提供服务" }
}
```

- `__usePrivacyCheck__` 与自定义隐私授权弹窗（`tig-privacy-popup` + `utils/privacy.ts`）已生效。
- ✅ **已处理（方案 A，2026-09-01）**：`requiredPrivateInfos`（`chooseLocation`/`chooseAddress`）与 `permission.scope.userLocation` 因代码中无实际调用，已从 `src/manifest.json` 移除，并重新执行 `npm run build:mp-weixin`；产物 `dist/build/mp-weixin/app.json` 已确认不再包含上述声明，仅保留 `scope.writePhotosAlbum`（海报保存到相册真实用到）。

---

## 二、代码实际调用的隐私接口（必须与后台声明对齐）

| # | 隐私接口 | 调用位置 | 用途 | 后台须声明的信息类型 |
|---|---------|---------|------|------|
| 1 | `getPhoneNumber`（button open-type） | `components/tig/tig-wechart-login/tig-wechart-login.vue:10`（走 `getWechartMobile` → `user/login/getMobile`）；`pages/user/bindMobilePhone/index.vue` | 手机号快捷登录 / 绑定手机号 | **手机号** |
| 2 | `uni.chooseImage` | `components/tig/tig-upload/tig-upload.vue:32`（头像 `user/user/modifyAvatar`、评价、售后图片） | 从相册/相机选图上传 | **选中的照片或视频信息** |
| 3 | `uni.saveImageToPhotosAlbum` | `components/product/poster.vue:189`、`utils/index.ts`（`saveImageToMp` / `saveImageToApp`） | 保存商品海报图到相册 | **相册（仅写入）权限** |
| 4 | `wx.requestSubscribeMessage` | `pages/order/check.vue:306`（`#ifdef MP-WEIXIN`） | 下单页订阅消息推送 | **小程序消息（订阅消息）** |

---

## 三、可直接粘贴到微信后台的文案

### 1. 手机号
- **收集信息**：手机号
- **使用目的**：
  ```
  用于将用户手机号与账户进行绑定，作为登录凭证与账户找回方式，避免用户因忘记密码或账号导致无法登录。
  ```

### 2. 选中的照片或视频
- **收集信息**：用户主动选择上传的图片/视频
- **使用目的**：
  ```
  用于用户从相册或摄像头选择图片，以上传/更换头像，以及在订单评价、售后申请等场景上传凭证图片。
  ```
- ⚠️ 注意：这一项与「相册（仅写入）」是**两个不同**声明。头像上传走 `chooseImage`（读相册选图），**必须单独勾选**，不能只声明「相册写入」。

### 3. 相册（仅写入）权限
- **收集信息**：无（仅向相册写入文件）
- **使用目的**：
  ```
  用于在用户主动操作时，将生成的商品分享海报图片保存至用户手机相册，方便用户分享。
  ```

### 4. 小程序消息（订阅消息）
- **收集信息**：订阅消息授权状态、openid
- **使用目的**：
  ```
  用于在用户下单后，向用户推送订单状态、发货、售后处理进度等服务通知，便于用户及时了解订单动态。
  ```

### （可选）日志信息 / 设备信息
如合规模板要求，可统一加一句：
```
为保障账户与系统安全、排查故障，我们会记录必要的操作日志与设备信息。
```

---

## 三·补二：第 6 节「信息的使用」6.2 填写文案

> 对应微信后台隐私指引模板 **第 6 节 Use of Information** 中 **6.2** 的输入框。
> 6.1 为固定文案无需改动；6.2 的语义是「若超出本指引目的使用信息，改变目的前须以**何种方式**重新征得您的明确同意」，故此处填写的是**重新征求同意的具体方式**。

- **可直接粘贴到 6.2 输入框**：
  ```
  再次通过本小程序内的隐私授权弹窗向您展示变更后的信息处理目的与范围，并在您主动点击“同意”后方可继续使用；您也可选择拒绝或停止使用相关功能。
  ```
- 依据：本项目已有自定义隐私授权弹窗（`components/tig/tig-privacy-popup` + `utils/privacy.ts` 的 `agreePrivacyAuthorization`），后台声明与代码真实行为一致，审核对照无冲突。
- ⚠️ 不要写成"以适当方式通知"等模糊措辞；必须落到"弹窗 + 明确同意"这种可验证动作上。

---

## 三·补：第三方插件信息 / SDK 信息（**当前无需填写**）

> 对应微信后台「设置 → 服务内容声明 → 用户隐私保护指引」中的 **「2. 第三方插件信息/SDK信息」** 一栏。
> 该栏**只用于声明会处理用户个人信息的第三方 SDK / 插件**（如友盟统计、极光推送、腾讯位置服务、Bugly、神策、第三方广告/客服/地图 SDK 等）。

**结论：本小程序当前未引入任何会处理用户个人信息的第三方 SDK，此栏直接留空、跳过即可，无需点击「添加第三方SDK信息」。**

核对依据（基于 `package.json` 依赖与 `src/` 全量代码）：

| 引入项 | 性质 | 是否需在此栏声明 |
|---|---|---|
| `@dcloudio/*`（uni-app 框架）、`vue`、`pinia`、`vue-i18n` | 编译期框架 / 状态 / 国际化库 | 否 |
| `uview-plus`、`@dcloudio/uni-ui` | 纯 UI 组件库 | 否 |
| `clipboard`、`crypto-js`、`dayjs`、`uqrcodejs` | 本地工具库，不联网、不采集 | 否 |
| 微信支付 `wx.requestPayment` / `uni.requestPayment`（`pages/order/pay.vue`） | 腾讯**官方**支付能力，非第三方 SDK | 否 |
| 客服（`src/components/service`） | 走**企业微信客服**（微信官方能力），非第三方 SDK | 否 |
| `uniStatistics`（`manifest.json`） | `enable: false`，未启用 | 否 |

- 代码中**未发现**腾讯位置服务 Key、友盟、Bugly、极光、神策等任何第三方采集 SDK 的痕迹。
- ⚠️ 提示：此栏为**条件性**填写项。强行乱填反而可能在审核时被对照代码质疑；只有将来真正接入会处理个人信息的第三方 SDK 时，再逐条补充。

---

## 四、待处理 / 存疑项

### ✅ 问题 1（已解决·方案 A）：`requiredPrivateInfos` 声明了未实际调用的接口
全 `src/` 搜索 `chooseLocation` / `chooseAddress` 的实际调用，**结果为 0**：
- `utils/index.ts:219` 只是一行注释（紧邻 `uni.setClipboardData` 的 fail 分支），与 `chooseLocation` 无关；
- 不存在任何 `uni.chooseLocation(...)` / `uni.chooseAddress(...)` 调用。

**影响**：
- 后台隐私指引**暂不勾选**「位置信息」「地址」即可；
- `app.json` 里的 `scope.userLocation` 同属「声明未使用」，建议后续清理或在确实接入相关功能时再补齐。

**两种处理方案（择一）**：
- **不保留定位/地址** → 从 `manifest.json`（`mp-weixin.requiredPrivateInfos`、`permission.scope.userLocation`）移除，重新 `npm run build:mp-weixin`。
- **保留定位/地址** → 在地址/定位相关页补回 `chooseLocation`/`chooseAddress` 真实调用，并在后台隐私指引增加「位置信息」「地址」。

---

## 五、操作流程建议

1. 将「三、可直接粘贴」中的 1–4 项逐条填入后台并**提交审核**。
2. 处理「四、待处理」中的 `requiredPrivateInfos` / `scope.userLocation` 声明与实际不符问题。
3. 等隐私指引审核通过后，再执行：
   ```bash
   cd /Users/gump/Desktop/water/git/watergit/water/view/Tigshop-Uniapp
   npm run build:mp-weixin
   ```
4. 上传 `dist/build/mp-weixin` 代码包。

---

## 六、隐私授权弹窗相关代码索引

- `src/utils/privacy.ts`：`initPrivacyAuthorization()` / `agreePrivacyAuthorization()` / `disagreePrivacyAuthorization()` / `privacyPopupVisible`
- `src/components/tig/tig-privacy-popup/tig-privacy-popup.vue`：自定义授权弹窗（同意按钮 `open-type="agreePrivacyAuthorization"`）
- `src/components/tig/tig-layout/tig-layout.vue`：在 `#ifdef MP-WEIXIN` 下挂载 `tig-privacy-popup`
- `src/App.vue`：小程序启动时初始化隐私授权监听
- 协议页复用：`mallAgreement?articleSn=ysxy`（隐私协议）、`mallAgreement?articleSn=fwxy`（服务协议）
