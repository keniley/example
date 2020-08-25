<div class="modal-header">
    <h4 class="modal-title"><i class="icon icon-help"></i>Poptávka kurzu</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
    <form class="ajaxform" method="post" action="/message">
      @csrf

      <div class="form-group mb-3">
        <label for="name">Jméno</label>
        <input name="name" class="form-control form-control-sm" id="name">
      </div>

      <div class="form-group mb-3">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input name="email" class="form-control form-control-sm" id="email" type="email">
      </div>

      <div class="form-group mb-3">
        <label for="phone">Telefon</label>
        <input name="phone" class="form-control form-control-sm" id="phone" type="tel">
      </div>

      <div class="form-group mb-3">
        <label for="course">Kurz</label>
        <input name="course" class="form-control form-control-sm" id="course" value="{{ $course }}" readonly>
      </div>

      <div class="form-group mb-3">
        <label for="message">Zpráva <span class="text-danger">*</span></label>
        <textarea name="message" type="textarea" class="form-control form-control-sm" style="height: 250px" id="message"></textarea>
      </div>

      <div class="form-group mb-3 d-flex">
        <label class="switch switch-cz">
          <input type="hidden" name="gdpr" value="0">
          <input type="checkbox" name="gdpr" value="1">
          <span class="checkmark"></span>
        </label>
        <div class="size-0-8 pl-2">Souhlasím se zpracováním osobních údajů <span class="text-danger">*</span></div>
      </div>

      <div class="form-group mb-3 d-flex">
        <label class="switch switch-cz">
          <input type="hidden" name="newsletter" value="0">
          <input type="checkbox" name="newsletter" value="1">
          <span class="checkmark"></span>
        </label>
        <div class="size-0-8 pl-2">Přeji si zasílat novinky z Avantýny</div>
      </div>

      <button type="submit" class="btn btn-success materialize">Odeslat dotaz</button>
    </form>
</div>