<div class="modal-header">
    <h4 class="modal-title"><i class="icon icon-help"></i>Nový adminstrátor</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
    <form class="ajaxform" method="post" action="/admin/admins">
        @csrf
      <div class="form-group mb-3">
        <label for="email">Email</label>
        <input name="email" class="form-control form-control-sm" id="email">
      </div>
      <button type="submit" class="btn btn-success btn-sm materialize">Vytvořit</button>
    </form>
</div>