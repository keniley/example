<div class="modal-header">
    <h4 class="modal-title"><i class="icon icon-help"></i>Nový text na webu</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
    <form class="ajaxform" method="post" action="/admin/content">
        @csrf
      <div class="form-group mb-3">
        <label for="title">Název</label>
        <input name="title" class="form-control form-control-sm" id="title">
      </div>
      <button type="submit" class="btn btn-success btn-sm materialize">Vytvořit</button>
    </form>
</div>