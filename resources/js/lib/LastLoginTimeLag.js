export default {
    getLastLoginTimeLag(value) {
        // 現在の時刻のタイムスタンプを取得
        const currentTimestamp = Math.trunc(new Date().getTime() / 1000);
        // 引数（value)のタイムスタンプを取得
        const lastLoginTime = Math.trunc(new Date(value).getTime() / 1000);
        // 差分を取得
        const timeLag = currentTimestamp - lastLoginTime;
        if (timeLag > 2592000) {
            const month = Math.trunc(timeLag / 2592000);
            return `${month}ヶ月前`;
        } else if (timeLag > 86400) {
            const day = Math.trunc(timeLag / 86400);
            return `${day}日前`;
        } else if (timeLag > 3600) {
            const hour = Math.trunc(timeLag / 3600);
            return `${hour}時間前`;
        } else if (timeLag > 60) {
            const min = Math.trunc(timeLag / 60);
            return `${min}分前`;
        } else {
            return '0分前';
        }
    },
};
