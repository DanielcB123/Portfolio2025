import axios from 'axios'

const api = axios.create({
  baseURL: '/api',
})

api.interceptors.request.use((config) => {
  const apiKey = localStorage.getItem('api_key')
  if (apiKey) {
    config.headers['X-API-Key'] = apiKey
  }
  return config
})

export default {
  getTasks() {
    return api.get('/tasks')
  },
  createTask(payload) {
    return api.post('/tasks', payload)
  },
  updateTask(id, payload) {
    return api.put(`/tasks/${id}`, payload)
  },
  deleteTask(id) {
    return api.delete(`/tasks/${id}`)
  },
}
