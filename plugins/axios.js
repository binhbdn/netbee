export default ({ $axios,$auth,redirect }) => {
    $axios.defaults.baseURL = "https://netbee.vn/api/";
    $axios.onResponseError(err => {
        const code = parseInt(err.response && err.response.status);
        if (code == 401) {
          $auth.logout();
        }
      });
}