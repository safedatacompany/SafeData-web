// resources/js/plugins/useTranslate.js
export default function useTranslate(translations = {}) {
    return (key) => translations?.[key] ?? key;
}