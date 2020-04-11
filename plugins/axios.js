export default ({ $axios }) => {
    $axios.defaults.baseURL = "http://127.0.0.1:8000/api/";
    $axios.setToken('123', 'Bearer')
}