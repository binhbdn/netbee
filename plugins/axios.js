export default ({ $axios,$auth,redirect }) => {
    $axios.defaults.baseURL = "http://en-el.devwork.vn/api/";
    $axios.onResponseError(err => {
        const code = parseInt(err.response && err.response.status);
        if (code == 401) {
          $auth.logout();
        }
      });
}