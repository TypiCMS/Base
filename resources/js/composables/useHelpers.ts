export default function useHelpers() {
    function formatDate(date: string) {
        if (date === null) {
            return '';
        }
        return new Date(date).toLocaleDateString(TypiCMS.locale_region);
    }
    function formatDateTime(date: string) {
        if (date === null) {
            return '';
        }
        return new Date(date).toLocaleString(TypiCMS.locale_region);
    }
    function $can(permissionName: string) {
        return TypiCMS.permissions.includes('all') || TypiCMS.permissions.includes(permissionName);
    }
    return {
        formatDate,
        formatDateTime,
        $can,
    };
}
