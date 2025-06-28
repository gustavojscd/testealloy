import axios from 'axios';
window.axios = axios;
axios.defaults.baseURL = import.meta.env.VITE_API_URL
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.common['Content-Type'] = 'application/json'
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
