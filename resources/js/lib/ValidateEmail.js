export default {
    validate(value) {
        const mail_regex1 = new RegExp(
            "(?:[-!#-'*+/-9=?A-Z^-~]+.?(?:.[-!#-'*+/-9=?A-Z^-~]+)*|\"(?:[!#-[]-~]|\\\\[\x09 -~])*\")@[-!#-'*+/-9=?A-Z^-~]+(?:.[-!#-'*+/-9=?A-Z^-~]+)*"
        );
        const mail_regex2 = new RegExp('^[^@]+@[^@]+$');
        if (!value) {
            return 'メールアドレスを設定してください';
        } else if (value.match(mail_regex1) && value.match(mail_regex2)) {
            // 全角チェック
            if (value.match(/[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/)) {
                return '全角は使用できません';
            }
            // 末尾TLDチェック（〜.co,jpなどの末尾ミスチェック用）
            if (!value.match(/\.[a-z]+$/)) {
                return 'メールアドレスの形式で入力してください';
            }
            return '';
        } else {
            return 'メールアドレスの形式で入力してください';
        }
    },
};
