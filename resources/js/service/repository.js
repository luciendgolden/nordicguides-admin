import axios from 'axios';

const baseDomain = 'http://nordicguides-admin.test';
const baseURL = `${baseDomain}/api`;

export default axios.create({ baseURL });
