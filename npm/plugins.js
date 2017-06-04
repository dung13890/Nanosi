var plugins = {
  bower: [
    {
      in: 'AdminLTE/dist',
      out: 'adminlte'
    },
    {
      in: 'bootstrap/dist',
      out: 'bootstrap'
    },
    {
      in: 'jquery/dist',
      out: 'jquery'
    },
    {
      in: 'elevatezoom',
      out: 'elevatezoom'
    },
    {
      in: 'fancybox/dist',
      out: 'fancybox'
    },
    {
      in: 'components-font-awesome/css',
      out: 'font-awesome/css'
    },
    {
      in: 'components-font-awesome/fonts',
      out: 'font-awesome/fonts'
    },
    {
      in: 'datatables.net/js',
      out: 'datatables/js'
    },
    {
      in: 'datatables.net-bs/css',
      out: 'datatables-bs/css'
    },
    {
      in: 'datatables.net-bs/js',
      out: 'datatables-bs/js'
    },
    {
      in: 'jasny-bootstrap/dist',
      out: 'jasny-bootstrap'
    },
    {
      in: 'summernote/dist',
      out: 'summernote'
    },
    {
      in: 'jqTree/tree.jquery.js',
      out: 'jqtree/js'
    },
    {
      in: 'jqTree/jqtree.css',
      out: 'jqtree/css'
    }
  ],
  sass: [
    {
      in: 'backend/app.scss',
      out: 'backend/app.css'
    },
    {
      in: 'backend/dropzone.scss',
      out: 'backend/dropzone.css'
    },
    {
      in: 'frontend/app.scss',
      out: 'frontend/app.css'
    }
  ]
}
module.exports = plugins;
