<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="schools-select">Escoger escuela</label>
                        {{-- <select wire:model="escuela_id" class="form-control form-select" name="schools-select" aria-label="Schools select" required>@error('escuela_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            <option selected disabled>Escuela</option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->name}}</option>
                            @endforeach
                        </select> --}}
                        <select wire:model="school.id" class="form-control form-select" name="schools-select" aria-label="Schools select" required>@error('school.id') <span class="error text-danger">{{ $message }}</span> @enderror
                            <option selected disabled>Escoger escuela...</option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nombre" required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="ubication">Localidad</label>
                        <input wire:model="ubication" type="text" class="form-control" id="ubication" placeholder="Localidad" required>@error('ubication') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>   
                    <div class="form-group">
                        <label for="start_date">Fecha de inicio</label>
                        <input wire:model="start_date" type="text" id="datepicker" class="form-control" placeholder="YYYY-MM-DD" required>@error('start_date') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="duration">Duración (h)</label>
                        <input wire:model="duration" type="text" class="form-control" id="hours" placeholder="Duración (h)" required>@error('duration') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen</label>
                        <input wire:model="image" type="file" class="form-control" id="image" name="image" placeholder="Imagen" required>@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="code">Código</label>
                        <input wire:model="code" type="text" class="form-control" id="code" placeholder="Código">@error('code') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input wire:model="url" onclick="getFormData()" type="text" class="form-control" id="url" placeholder="Url" required>@error('url') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>

{{-- <script src="moment.js"></script>
<script src="pikaday.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-D',
        onSelect: function() {
            var dateFormated = document.getElementById('datepicker');
            console.log(this.getMoment().format('YYYY-MM-DD'));
            console.log(dateFormated.value);
        }
    });

    function getFormData() {
        var name = document.getElementById('nname').value;
        var ubication = document.getElementById('ubication').value;
        var datepicker = document.getElementById('datepicker').value;
        var duration = document.getElementById('duration').value;
        var img = document.getElementById('image').value;
        var code = document.getElementById('code').value;
        var url = document.getElementById('url').value;
        var formData = name + " " + ubication + " " + datepicker + " " + hours + " " + img + " " + code + " " + url;
        console.log(formData);
        return formData;
    }
</script>