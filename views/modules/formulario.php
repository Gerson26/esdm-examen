<div class="col-md-5 col-sm-12">
    <div class="alert alert-danger mt-3" role="alert" style="display: none;" id="msg-error">
        Debes de llenar todos los campos!!!
    </div>
    
    <div class="card mt-2">
        <form id="form-producto">
            <div class="card-header">
                <h5 id="titulo-form"></h5>
            </div>
            <div class="card-body">  
                <input type="hidden" id="id"/>                  
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" >
                </div>
        
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" min="1" pattern="^[0-9]+" class="form-control" id="cantidad">
                </div>
        
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" rows="5"></textarea>
                </div>                         
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block" id="btn-guardar">Guardar</button>
                <button type="submit" class="btn btn-info btn-block" id="btn-actualizar" style="display: none;">Actualizar</button>
            </div>
        </form>
    </div>

</div>