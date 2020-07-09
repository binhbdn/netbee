export default ({ $axios, $auth, redirect }) => {
  $axios.defaults.baseURL = "http://127.0.0.1:8000/api/";
  $axios.onResponseError(err => {
    const code = parseInt(err.response && err.response.status);
    if (code == 401) {
      $auth.logout();
    }
  });
};