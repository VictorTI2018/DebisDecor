import Vue from 'vue'
import session from '../utils/session'
import VueAxios from 'vue-axios'
import axios from 'axios'
import axiosCancel from 'axios-cancel'

const http = axios.create({
    baseURL: 'http://localhost:8000/'
})

axiosCancel(http)

Vue.use(VueAxios, http)

http.interceptors.request.use((config) => {
    if (session.exists()) {
        config.headers['Authorization'] = `Bearer ${session.get('token')}`
    }
    return config
}, error => {
    return Promise.reject(error)
})

export default http