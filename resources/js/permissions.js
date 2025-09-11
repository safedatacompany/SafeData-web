import { usePage } from '@inertiajs/vue3';

export default {
  install(app) {
    app.config.globalProperties.$can = (permission) => {
      const { props } = usePage();

      const userPermissions = props.auth.user.permissions || [];
      return userPermissions.some(userPermission => userPermission.name === permission);
    };
  },
};