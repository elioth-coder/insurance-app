import axios from 'axios';
import Swal from 'sweetalert2';
import { DataTable } from 'simple-datatables';

window.axios = axios;
window.Swal = Swal;
window.DataTable = DataTable;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
