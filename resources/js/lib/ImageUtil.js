import imageCompression, { getDataUrlFromFile } from 'browser-image-compression';

export default {
    // アップロードされた画像ファイルを取得
    async getCompressImageFile(file) {
        const options = {
            maxSizeMB: 1, // 最大ファイルサイズ
        };
        try {
            // 圧縮画像の生成
            return await imageCompression(file, options);
        } catch (error) {
            console.log('getCompressImageFileAsync is error', error);
            throw error;
        }
    },
    // プレビュー表示用のDataUrlを取得
    async getDataUrlFromFile(file) {
        try {
            return await imageCompression.getDataUrlFromFile(file);
        } catch (error) {
            console.log('getDataUrlFromFile is error', error);
            throw error;
        }
    },
};
