import axios from 'axios';
import { DataTable } from 'simple-datatables';

window.DataTable = DataTable;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
