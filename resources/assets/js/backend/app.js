var CRUD = (function () {
  var _router, _$;
  var _resource, _data;
  var _onDatatables = false;
  var _datatables, _columns, _searches;
  var _selector;

  var _listeners = {
    ready: function () {}
  };

  function CRUD(resource, data) {
    _resource = resource;
    _data = data || {};
    this.setRouter();
    this.setJquery();
    document.addEventListener("DOMContentLoaded", _onReady);
  };

  function _onReady(event) {
    return _listeners.ready();
  }

  CRUD.prototype.setRouter = function (router) {
    _router = router || window.router || laroute || window.laroute;
    
    return _router;
  };

  CRUD.prototype.setJquery = function ($) {
    _$ = $ || jQuery || window.jQuery || window.$;
    _$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      }
    });
    
    return _$;
  };

  CRUD.prototype.setDatatables = function (columns, searches, selector, enable) {
    _columns = columns || [];
    _searches = searches || {
      data: function (d) {
        d.keyword = _$('input[name=keyword]').val();
      }
    };
    _selector = selector || "#table-index";
    _onDatatables = enable || true;

    return this;
  };

  CRUD.prototype.initDatatables = function () {
    _columns.push({
      name: "actions",
      searchable: false,
      orderable: false,
      render: function (data, type, row) {
        var actions = {
          edit: function () {
            return row.actions.edit ? '<a href="' + row.actions.edit.uri + '" title="' + row.actions.edit.label + '" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>' : '';
          },
          delete: function () {
            return row.actions.delete ? '<a href="' + row.actions.delete.uri + '" title="' + row.actions.delete.label + '" class="btn btn-danger btn-xs delete-action"><i class="fa fa-times"></i></a>' : '';
          }
        }

        return actions.edit() + actions.delete();
      }
    });

    _datatables = _$(_selector).DataTable({
      dom: "<'row'<'col-xs-6'l>>"+
        "<'row'<'col-xs-12't>>"+
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      processing: true,
      serverSide: true,
      responsive: true,
      columns: _columns,
      order: [[0, 'desc' ]],
      searching: false,
      language: {
        search:"_INPUT_",
        lengthMenu: "_MENU_",
      },
      ajax: _$.extend({
        url: _router.route('backend.' + _resource + '.index', {'datatables': 1})
      }, _searches)
    });

    _$(document).on('click', 'a.delete-action', function(event) {
      var $ = _$;
      event.preventDefault();
      var $this = $(this);
      var href = $this.attr('href');

      var callback = function () {
        _$.post(href, {_method: 'DELETE'}, function() {})
        .done(function (data) {
          toastr.success(data.message);
          $this.closest('tr').fadeOut(400, function() {
            $this.remove();
          });
        })
        .fail(function(xhr) {
          console.log(xhr);
          if (xhr && xhr.responseJSON) {
            return toastr.error(xhr.responseJSON.message);
          }

          return toastr.error('An error has occurred');
        });
      }

      swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ok!",
        cancelButtonText: "Cancel",
      }, function() {
        return callback();
      });
    });

    return this;
  }

  CRUD.prototype.refresh = function () {
    _datatables.draw();

    return this;
  }

  CRUD.prototype.index = function () {
    var self = this;
    if (_onDatatables) {
      var callback = _listeners.ready;
      _listeners.ready = function () {
        self.initDatatables();
        callback();
      }
    }
  };

  CRUD.prototype.flash = function (message) {
    if (typeof message !== 'undefined' && message) {
      var e = JSON.parse(message);
      e.code == 0 ? toastr.success(e.message) : toastr.error(e.message);
    }
  }

  CRUD.prototype.sendImage = function(file, url, $element, callback) {
    var callback = callback || null;
    var  data = new FormData();
    data.append("image", file);
    _$.ajax({
      data: data,
      type: "POST",
      url: url,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        $element.summernote("insertImage", data.url);
      },
      error: function(xhr, textStatus, error) {
        alert('Đã có lỗi xảy ra..! Kiểm tra lại file ảnh của bạn.');
      }
    });
    if (callback) {
      callback.apply(this);
    }
  }

  return CRUD;
})();
