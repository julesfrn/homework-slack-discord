import axios from 'axios'

const headers = {
  'Accept': 'application/json',
  'Content-Type': 'application/json'
}

export default class HomeworkService {
  static async index() {
    const { data } = await axios.get('/api/homeworks', { headers })
    return data
  }

  static async create(payload) {
    return await axios.post('/api/homeworks', payload, { headers })
  }
}
