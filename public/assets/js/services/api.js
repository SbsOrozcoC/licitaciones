window.api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    }
});

window.api.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        console.error('API Error:', error.response || error);
        return Promise.reject(error);
    }
);
