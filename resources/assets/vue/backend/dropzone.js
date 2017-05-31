var Vue = require('vue');
import UploadImage from './components/upload-image.vue';
var router = window.router || laroute || window.laroute;
require('es6-promise').polyfill()
new Vue({
  el : '#dropzone-form',
  components : {
    'upload-image': UploadImage,
  },
  data:{
    item :window.item || {}
  }
});
