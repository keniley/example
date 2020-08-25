<div class="modal-header">
    <h4 class="modal-title"><i class="icon icon-help"></i>Detail zprávy z webu</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
      @if($message)
          <div class="form-group mb-3">
            <label for="name">Jméno</label>
            <input name="name" class="form-control form-control-sm" id="name" readonly value="{{ $message->name }}">
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input name="email" class="form-control form-control-sm" id="email" readonly value="{{ $message->email }}">
          </div>
          <div class="form-group mb-3">
            <label for="phone">Telefon</label>
            <input name="phone" class="form-control form-control-sm" id="phone" readonly value="{{ $message->phone }}">
          </div>
          @if($message->type === 'course')
            <div class="form-group mb-3">
              <label for="course">Kurz</label>
              <input name="course" class="form-control form-control-sm" id="course" readonly value="{{ $message->course }}">
            </div>
          @endif
          <div class="form-group mb-3">
            <label for="message">Zpráva</label>
            <textarea name="message" class="form-control form-control-sm" style="height: 250px" id="message" readonly>{{ $message->message }}</textarea>
          </div>
      @else
        <div class="alert alert-warning" role="alert">Zpráva nebyla nalazena</div>
      @endif
</div>